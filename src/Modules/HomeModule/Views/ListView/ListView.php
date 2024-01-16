<?php

namespace MrEssex\CubexSkeleton\Modules\HomeModule\Views\ListView;

use MrEssex\CubexSkeleton\Modules\HomeModule\HomeModule;
use MrEssex\CubexSkeleton\Ui\AbstractView;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;

class ListView extends AbstractView
{
  public function getBlockName(): string
  {
    return 'list';
  }
}
