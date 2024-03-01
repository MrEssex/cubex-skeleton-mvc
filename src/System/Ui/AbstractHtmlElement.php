<?php

namespace MrEssex\CubexSkeleton\System\Ui;

use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\Ui\Html\TemplatedHtmlElement;
use PackagedUi\BemComponent\BemComponent;
use PackagedUi\BemComponent\BemComponentTrait;

abstract class AbstractHtmlElement extends TemplatedHtmlElement implements TranslatorAware, BemComponent
{
  use TranslatableTrait;
  use TranslatorAwareTrait;
  use BemComponentTrait;

  public function __construct()
  {
    $this->addClass($this->getBlockName());
  }
}
