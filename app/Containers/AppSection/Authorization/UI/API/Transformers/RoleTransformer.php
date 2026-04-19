<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use League\Fractal\Resource\Collection;

class RoleTransformer extends ParentTransformer
{
    protected array $availableIncludes = [
        'permissions',
    ];

    protected array $defaultIncludes = [];

    public function transform(Role $role): array
    {
        return [
            'type' => $role->getResourceKey(),
            'id' => $role->getHashedKey(),
            'name' => $role->getName(),
            'display_name' => $role->getDisplayName(),
            'description' => $role->getDescription(),
        ];
    }

    public function includePermissions(Role $role): Collection
    {
        return $this->collection($role->getPermissions(), new PermissionAdminTransformer());
    }
}
