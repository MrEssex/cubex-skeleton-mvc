<?php

namespace MrEssex\CubexSkeleton\Modules\HomeModule\Views\ListView;

use MrEssex\CubexSkeleton\System\Ui\AbstractView;

class ListView extends AbstractView
{
  public function getBlockName(): string
  {
    return 'list';
  }
}
