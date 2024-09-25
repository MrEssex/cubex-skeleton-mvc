<?php

namespace MrEssex\CubexSkeleton\System\ErrorView;

use MrEssex\CubexSkeleton\System\AbstractView;

class ErrorView extends AbstractView
{
  public function getBlockName(): string
  {
    return 'error';
  }
}
