<?php

namespace App\Containers\AppSection\Portfolio\UI\WEB\Controllers;

use App\Containers\AppSection\Portfolio\Actions\BuildPortfolioIndexPageDataAction;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

final class PortfolioIndexPageController extends WebController
{
    public function __construct(
        private readonly BuildPortfolioIndexPageDataAction $buildPortfolioIndexPageDataAction,
    ) {
    }

    public function __invoke(): View
    {
        return view(
            'appSection@portfolio::index',
            $this->buildPortfolioIndexPageDataAction->run(),
        );
    }
}
