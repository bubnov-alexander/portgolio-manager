<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use League\Fractal\Resource\Collection;

class UserTransformer extends ParentTransformer
{
    protected array $availableIncludes = [
        'roles',
        'permissions',
    ];

    protected array $defaultIncludes = [];

    public function transform(User $user): array
    {
        return [
            'type' => $user->getResourceKey(),
            'id' => $user->getHashedKey(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'email_verified_at' => $user->getEmailVerifiedAt(),
        ];
    }

    public function includeRoles(User $user): Collection
    {
        return $this->collection($user->getRoles(), new RoleTransformer());
    }

    public function includePermissions(User $user): Collection
    {
        return $this->collection($user->getPermissions(), new PermissionTransformer());
    }
}
