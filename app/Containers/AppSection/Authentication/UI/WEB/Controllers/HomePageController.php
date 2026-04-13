<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Tasks\BuildHomePageDataTask;
use App\Settings\ContactSettings;
use App\Settings\ProfileSettings;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;

final class HomePageController extends WebController
{
    public function __construct(
        private readonly ProfileSettings $profileSettings,
        private readonly ContactSettings $contactSettings,
        private readonly BuildHomePageDataTask $buildHomePageDataTask,
    )
    {
    }

    public function __invoke(): View
    {
        $data = $this->buildHomePageDataTask->run($this->profileSettings, $this->contactSettings);

        return view(
            'appSection@authentication::home', $data
        );
    }
}
