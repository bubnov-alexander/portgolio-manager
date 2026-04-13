<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(HomePageController::class)]
final class HomePageControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectView(): void
    {
        $controller = app(HomePageController::class);

        $view = app()->call($controller);

        $this->assertSame('appSection@authentication::home', $view->name());
        $this->assertArrayHasKey('profile', $view->getData());
        $this->assertArrayHasKey('contact', $view->getData());
        $this->assertArrayHasKey('heroName', $view->getData());
        $this->assertArrayHasKey('contacts', $view->getData());
    }
}
