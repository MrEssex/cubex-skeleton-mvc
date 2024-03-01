<?php

namespace MrEssex\CubexSkeleton\Modules\HomeModule\Views\HomeView;

use MrEssex\CubexSkeleton\Modules\HomeModule\HomeModule;
use MrEssex\CubexSkeleton\System\Ui\AbstractView;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;

class HomeView extends AbstractView
{
  public function getBlockName(): string
  {
    return 'home';
  }

  public function requireResources(Dispatch $dispatch): void
  {
    ResourceManager::componentClass(HomeModule::class, [], $dispatch)
      ->requireCss('css/home.min.css');
  }
}
