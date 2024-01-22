<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\HomeModule\Views\ListView;

use MrEssex\CubexSkeleton\Modules\HomeModule\Views\ListView\ListView;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;

class ListViewTest extends SharedTestCase
{
  public function testGetBlockName(): void
  {
    $view = new ListView();
    $this->assertEquals('list', $view->getBlockName());
  }
}
