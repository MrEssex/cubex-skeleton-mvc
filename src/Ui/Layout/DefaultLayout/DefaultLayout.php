<?php

namespace MrEssex\CubexSkeleton\Ui\Layout\DefaultLayout;

use MrEssex\CubexSkeleton\Ui\Layout\AbstractLayout;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;

class DefaultLayout extends AbstractLayout
{
  protected function _registerResources(Dispatch $dispatch): void
  {
    ResourceManager::resources([], $dispatch)
      ->requireCss('main.min.css')
      ->requireJs('main.min.js');
  }
}
