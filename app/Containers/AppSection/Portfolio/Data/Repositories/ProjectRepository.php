<?php

namespace App\Containers\AppSection\Portfolio\Data\Repositories;

use App\Containers\AppSection\Project\Models\Project;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

/**
 * @template TModel of Project
 *
 * @extends ParentRepository<TModel>
 */
final class ProjectRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'title' => 'like',
        'slug' => '=',
        'is_published' => '=',
    ];

    public function model(): string
    {
        return Project::class;
    }
}
