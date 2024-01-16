<?php

namespace MrEssex\CubexSkeleton\Ui\Layout;

use Packaged\Dispatch\Dispatch;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\Ui\Element;

abstract class AbstractLayout extends Element implements Layout, TranslatorAware
{
  use TranslatorAwareTrait;
  use TranslatableTrait;

  protected mixed $_content;

  public function __construct(public Dispatch $dispatch)
  {
    $this->_registerResources($this->dispatch);
  }

  abstract protected function _registerResources(Dispatch $dispatch): void;

  public function setContent(mixed $content): static
  {
    $this->_content = $content;
    return $this;
  }

  public function getContent(): mixed
  {
    return $this->_content;
  }
}
