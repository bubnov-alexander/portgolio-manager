<?php

namespace App\Containers\AppSection\Portfolio\Tasks;

use App\Containers\AppSection\Portfolio\Data\Repositories\ProjectRepository;
use App\Containers\AppSection\Project\Models\Project;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class FindPublishedProjectBySlugTask extends ParentTask
{
    public function __construct(
        private readonly ProjectRepository $repository,
    ) {
    }

    public function run(string $slug): Project
    {
        $project = $this->repository
            ->with([
                'technologies:id,name',
                'features' => fn ($query) => $query->orderBy('sort'),
                'media',
            ])
            ->where('is_published', true)
            ->where('slug', $slug)
            ->first();

        abort_if($project === null, 404);

        return $project;
    }
}
