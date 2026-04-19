<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Models\InteractsWithApiato;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authorization\Data\Collections\RoleCollection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Spatie\Permission\Models\Role as SpatieRole;

final class Role extends SpatieRole implements ResourceKeyAware
{
    use InteractsWithApiato;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): RoleCollection
    {
        return new RoleCollection($models);
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
     * @return EloquentCollection<int, Permission>
     */
    public function getPermissions(): EloquentCollection
    {
        return $this->permissions;
    }
}
