<?php

namespace MrEssex\CubexSkeleton\System\Ui;

use Cubex\ViewModel\TemplatedViewModel;
use Packaged\Dispatch\Dispatch;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use PackagedUi\BemComponent\BemComponent;
use PackagedUi\BemComponent\BemComponentTrait;

abstract class AbstractView extends TemplatedViewModel implements TranslatorAware, BemComponent
{
  use TranslatableTrait;
  use TranslatorAwareTrait;
  use BemComponentTrait;

  public function requireResources(Dispatch $dispatch): void { }
}
