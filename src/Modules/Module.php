<?php

namespace MrEssex\CubexSkeleton\Modules;

use Cubex\Cubex;

interface Module
{
  public function baseRoute(): string;

  public function defaultHandlerString(): string;

  public function setup(Cubex $cubex): void;
}
