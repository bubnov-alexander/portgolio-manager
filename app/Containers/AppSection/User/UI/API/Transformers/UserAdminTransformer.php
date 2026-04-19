<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use App\Containers\AppSection\User\Models\User;
use Carbon\CarbonInterface;

final class UserAdminTransformer extends UserTransformer
{
    public function transform(User $user): array
    {
        $createdAt = $user->getCreatedAt();
        $updatedAt = $user->getUpdatedAt();

        return parent::transform($user) +
       [
           'real_id' => $user->getRealId(),
           'created_at' => $createdAt,
           'updated_at' => $updatedAt,
           'readable_created_at' => $this->toHumanDate($createdAt),
           'readable_updated_at' => $this->toHumanDate($updatedAt),
       ];
    }

    private function toHumanDate(CarbonInterface|null $value): string|null
    {
        if ($value === null) {
            return null;
        }

        return $value->diffForHumans();
    }
}
