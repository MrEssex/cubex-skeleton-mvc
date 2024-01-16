<?php

namespace MrEssex\CubexSkeleton\Routing;

use Packaged\Context\Context;
use Packaged\Routing\Condition;

class PublicTextResourceCondition implements Condition
{
  public function match(Context $context): bool
  {
    $resourceRoutes = [
      'robots.txt',
      'sitemap.xml',
    ];

    return in_array(ltrim($context->request()->path(), '/'), $resourceRoutes);
  }

  public static function i(): static
  {
    return new static();
  }
}
