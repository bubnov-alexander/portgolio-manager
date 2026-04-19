<?php

namespace App\Containers\AppSection\Portfolio\UI\WEB\Views\Mappers;

use App\Containers\AppSection\Project\Models\Project;
use App\Containers\AppSection\Technology\Models\Technology;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class PortfolioViewMapper
{
    /**
     * @param array<int, Project> $projects
     *
     * @return array<int, array<string, mixed>>
     */
    public function mapIndexProjects(array $projects): array
    {
        return array_map(fn (Project $project): array => $this->mapIndexProject($project), $projects);
    }

    /**
     * @return array<string, mixed>
     */
    public function mapIndexProject(Project $project): array
    {
        /** @var ?Media $coverMedia */
        $coverMedia = $project->getFirstMedia('cover');

        return [
            'title' => $project->getTitle(),
            'slug' => $project->getSlug(),
            'short_description' => $project->getShortDescription(),
            'github_url' => $project->getGithubUrl(),
            'preview_url' => $project->getPreviewUrl(),
            'cover_url' => $coverMedia ? $this->toPublicUrl($coverMedia) : '',
            'technologies' => $project
                ->getTechnologies()
                ->map(static fn (Technology $technology): string => $technology->getName())
                ->all(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function mapShowProject(Project $project): array
    {
        /** @var ?Media $coverMedia */
        $coverMedia = $project->getFirstMedia('cover');

        $galleryUrls = $project
            ->getMedia('gallery')
            ->map(fn (Media $media): string => $this->toPublicUrl($media))
            ->values()
            ->all();

        $coverUrl = $coverMedia ? $this->toPublicUrl($coverMedia) : '';

        if ($coverUrl !== '' && count($galleryUrls) === 0) {
            $galleryUrls = [$coverUrl];
        }

        return [
            'project' => $project,
            'galleryUrls' => $galleryUrls,
            'coverUrl' => $coverUrl,
        ];
    }

    private function toPublicUrl(Media $media): string
    {
        $path = ltrim($media->getPathRelativeToRoot(), '/');

        if ($media->disk === 'public') {
            return '/storage/' . $path;
        }

        return '/media/' . $path;
    }
}
