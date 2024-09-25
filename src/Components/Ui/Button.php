<?php

namespace MrEssex\CubexSkeleton\Components\Ui;

use MrEssex\CubexSkeleton\Components\AbstractComponent;
use Packaged\SafeHtml\SafeHtml;

class Button extends AbstractComponent
{
  protected $_tag = 'button';
  protected $_content = '';

  public function getBlockName(): string
  {
    return 'button';
  }

  public function link($link): static
  {
    $this->setAttribute('href', $link);
    $this->_tag = 'a';
    return $this;
  }

  public function title($title): static
  {
    $this->setAttribute('title', $title);
    return $this;
  }

  public function content($content): static
  {
    $this->_content = $content;
    return $this;
  }

  public function pagelet(): static
  {
    if($this->getAttribute('href') !== null)
    {
      $this->setAttribute('data-uri', $this->getAttribute('href'));
    }

    return $this;
  }

  protected function _getContentForRender(): SafeHtml
  {
    return new SafeHtml($this->_content);
  }
}
