<?php

namespace App\Containers\AppSection\Portfolio\Data\Repositories;

use App\Containers\AppSection\Technology\Models\Technology;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

/**
 * @template TModel of Technology
 *
 * @extends ParentRepository<TModel>
 */
final class TechnologyRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'slug' => '=',
    ];

    public function model(): string
    {
        return Technology::class;
    }
}
