<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authorization\Enums\Role as RoleEnum;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Data\Collections\UserCollection;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Carbon\CarbonInterface;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

final class User extends ParentUserModel implements FilamentUser
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'immutable_datetime',
        'password' => 'hashed',
    ];

    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function getEmailVerifiedAt(): CarbonInterface|null
    {
        return $this->email_verified_at;
    }

    public function getRealId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): CarbonInterface|null
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): CarbonInterface|null
    {
        return $this->updated_at;
    }

    /**
     * @return EloquentCollection<int, Role>
     */
    public function getRoles(): EloquentCollection
    {
        return $this->roles;
    }

    /**
     * @return EloquentCollection<int, Permission>
     */
    public function getPermissions(): EloquentCollection
    {
        return $this->permissions;
    }

    /**
     * Allows Passport to find the user by email (case-insensitive).
     */
    public function findForPassport(string $username): self|null
    {
        return self::orWhereRaw('lower(email) = lower(?)', [$username])->first();
    }

    public function isSuperAdmin(): bool
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (!$this->hasRole(RoleEnum::SUPER_ADMIN, $guard)) {
                return false;
            }
        }

        return true;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin';
    }

    protected function email(): Attribute
    {
        return new Attribute(
            get: static fn (string|null $value): string|null => is_null($value) ? null : strtolower($value),
        );
    }
}
