<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\HomeModule;

use MrEssex\CubexSkeleton\Modules\HomeModule\HomeController;
use MrEssex\CubexSkeleton\Modules\HomeModule\HomeModule;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;

class HomeModuleTest extends SharedTestCase
{
  public function testGetBaseRoute(): void
  {
    $module = new HomeModule();
    $this->assertEquals('', $module->baseRoute());
  }

  public function testDefaultHandlerString(): void
  {
    $module = new HomeModule();
    $this->assertEquals(HomeController::class, $module->defaultHandlerString());
  }
}
