<?php

namespace MrEssex\CubexSkeleton\Modules\HomeModule;

use Cubex\Cubex;
use MrEssex\CubexSkeleton\Modules\Module;

class HomeModule implements Module
{
  public function baseRoute(): string
  {
    return '';
  }

  public function defaultHandlerString(): string
  {
    return HomeController::class;
  }

  public function setup(Cubex $cubex): void
  {
    // TODO: Implement setup() method.
  }
}
