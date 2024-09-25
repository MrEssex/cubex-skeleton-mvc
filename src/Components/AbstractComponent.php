<?php

namespace MrEssex\CubexSkeleton\Components;

use Cubex\Cubex;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\Ui\Html\TemplatedHtmlElement;
use PackagedUi\BemComponent\BemComponent;
use PackagedUi\BemComponent\BemComponentTrait;

abstract class AbstractComponent extends TemplatedHtmlElement implements TranslatorAware, BemComponent
{
  use TranslatableTrait;
  use TranslatorAwareTrait;
  use BemComponentTrait;

  public function __construct()
  {
    $this->addClass($this->getBlockName());
  }

  public static function i(Cubex $cubex): static
  {
    return $cubex->resolve(static::class);
  }
}
