<?php

namespace MrEssex\CubexSkeleton\System\Layout\LayoutWrap;

use MrEssex\CubexSkeleton\System\Layout\AbstractLayout;
use Packaged\Dispatch\Dispatch;
use Packaged\I18n\TranslatableTrait;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\TranslatorAwareTrait;
use Packaged\Ui\Element;

class LayoutWrap extends Element implements TranslatorAware
{
  use TranslatorAwareTrait;
  use TranslatableTrait;

  protected string $_content;

  public function __construct(public Dispatch $dispatch) { }

  public function setContent(AbstractLayout $content): static
  {
    $this->_content = $content->render();
    return $this;
  }

  public function getContent(): mixed
  {
    return $this->_content;
  }
}
