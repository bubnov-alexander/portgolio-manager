<?php

namespace App\Containers\AppSection\Portfolio\Tasks;

use App\Containers\AppSection\Portfolio\Data\Repositories\ProjectRepository;
use App\Containers\AppSection\Project\Models\Project;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\Collection;

final class ListPublishedProjectsTask extends ParentTask
{
    public function __construct(
        private readonly ProjectRepository $repository,
    ) {
    }

    /**
     * @return Collection<int, Project>
     */
    public function run(?int $limit = null): Collection
    {
        $query = $this->repository
                ->with(['technologies:id,name', 'media'])
                ->where('is_published', true)
                ->orderBy('sort')
                ->orderByDesc('id');

        if ($limit !== null) {
            $query->limit($limit);
        }

        $projects = $query->get();

        $this->repository->resetScope();

        return $projects;
    }
}
