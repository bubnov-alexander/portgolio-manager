<?php

use App\Containers\AppSection\Portfolio\UI\WEB\Controllers\PortfolioIndexPageController;
use App\Containers\AppSection\Portfolio\UI\WEB\Controllers\PortfolioShowPageController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio', PortfolioIndexPageController::class)
    ->name('portfolio.index');

Route::get('/portfolio/{slug}', PortfolioShowPageController::class)
    ->name('portfolio.show');
