<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Models\InteractsWithApiato;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Spatie\Permission\Models\Permission as SpatiePermission;

final class Permission extends SpatiePermission implements ResourceKeyAware
{
    use InteractsWithApiato;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): PermissionCollection
    {
        return new PermissionCollection($models);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDisplayName(): string|null
    {
        return $this->display_name;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function getGuardName(): string
    {
        return $this->guard_name;
    }

    /**
     * @return EloquentCollection<int, Role>
     */
    public function getRoles(): EloquentCollection
    {
        return $this->roles;
    }
}
