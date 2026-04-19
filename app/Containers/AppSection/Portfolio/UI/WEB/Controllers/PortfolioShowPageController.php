<?php

namespace App\Containers\AppSection\Portfolio\UI\WEB\Controllers;

use App\Containers\AppSection\Portfolio\Actions\BuildPortfolioShowPageDataAction;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

final class PortfolioShowPageController extends WebController
{
    public function __construct(
        private readonly BuildPortfolioShowPageDataAction $buildPortfolioShowPageDataAction,
    ) {
    }

    public function __invoke(string $slug): View
    {
        return view(
            'appSection@portfolio::show',
            $this->buildPortfolioShowPageDataAction->run($slug),
        );
    }
}
