<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\HomeModule\Views\HomeView;

use MrEssex\CubexSkeleton\Modules\HomeModule\Views\HomeView\HomeView;
use PHPUnit\Framework\TestCase;

class HomeViewTest extends TestCase
{
  public function testGetBlockName()
  {
    $view = new HomeView();
    $this->assertEquals('home', $view->getBlockName());
  }
}
