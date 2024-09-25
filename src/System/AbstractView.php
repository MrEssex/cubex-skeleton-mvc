<?php

namespace MrEssex\CubexSkeleton\System;

use Cubex\ViewModel\TemplatedViewModel;
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
}
