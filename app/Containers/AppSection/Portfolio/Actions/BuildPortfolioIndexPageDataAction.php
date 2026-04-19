<?php

namespace App\Containers\AppSection\Portfolio\Actions;

use App\Containers\AppSection\Portfolio\Tasks\ListPublishedProjectsTask;
use App\Containers\AppSection\Portfolio\UI\WEB\Views\Mappers\PortfolioViewMapper;
use App\Settings\ProfileSettings;
use App\Ship\Parents\Actions\Action as ParentAction;

final class BuildPortfolioIndexPageDataAction extends ParentAction
{
    public function __construct(
        private readonly ListPublishedProjectsTask $listPublishedProjectsTask,
        private readonly PortfolioViewMapper $portfolioViewMapper,
        private readonly ProfileSettings $profileSettings,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function run(): array
    {
        $projects = $this->listPublishedProjectsTask->run()->all();

        return [
            'projects' => $this->portfolioViewMapper->mapIndexProjects($projects),
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
