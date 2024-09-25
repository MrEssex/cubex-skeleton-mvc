<?php

namespace MrEssex\CubexSkeleton\System\Layout\DefaultLayout;

use MrEssex\CubexSkeleton\System\Layout\AbstractLayout;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;

class DefaultLayout extends AbstractLayout
{
  public function getName(): string
  {
    return 'default';
  }
}
