<?php

namespace App\Containers\AppSection\Portfolio\Actions;

use App\Containers\AppSection\Portfolio\Tasks\FindPublishedProjectBySlugTask;
use App\Containers\AppSection\Portfolio\UI\WEB\Views\Mappers\PortfolioViewMapper;
use App\Settings\ProfileSettings;
use App\Ship\Parents\Actions\Action as ParentAction;

final class BuildPortfolioShowPageDataAction extends ParentAction
{
    public function __construct(
        private readonly FindPublishedProjectBySlugTask $findPublishedProjectBySlugTask,
        private readonly PortfolioViewMapper $portfolioViewMapper,
        private readonly ProfileSettings $profileSettings,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function run(string $slug): array
    {
        $project = $this->findPublishedProjectBySlugTask->run($slug);

        return [
            ...$this->portfolioViewMapper->mapShowProject($project),
            'headerBrand' => $this->buildHeaderBrand(),
            'activeNav' => 'portfolio',
        ];
    }

    private function buildHeaderBrand(): string
    {
        $nickname = trim($this->profileSettings->getNickname());

        if ($nickname === '') {
            return 'Backend Portfolio';
        }

        return '@' . ltrim($nickname, '@');
    }
}
