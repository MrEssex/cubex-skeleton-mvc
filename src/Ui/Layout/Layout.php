<?php

namespace MrEssex\CubexSkeleton\Ui\Layout;

interface Layout
{
  public function setContent(mixed $content): static;

  public function getContent(): mixed;
}
