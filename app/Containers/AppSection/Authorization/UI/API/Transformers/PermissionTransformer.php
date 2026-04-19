<?php

namespace App\Containers\AppSection\Authorization\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use League\Fractal\Resource\Collection;

class PermissionTransformer extends ParentTransformer
{
    protected array $availableIncludes = [
        'roles',
    ];

    protected array $defaultIncludes = [];

    public function transform(Permission $permission): array
    {
        return [
            'type' => $permission->getResourceKey(),
            'id' => $permission->getHashedKey(),
            'name' => $permission->getName(),
            'display_name' => $permission->getDisplayName(),
            'description' => $permission->getDescription(),
        ];
    }

    public function includeRoles(Permission $permission): Collection
    {
        return $this->collection($permission->getRoles(), new RoleAdminTransformer());
    }
}
