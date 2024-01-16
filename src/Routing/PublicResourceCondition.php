<?php

namespace MrEssex\CubexSkeleton\Routing;

use Packaged\Context\Context;
use Packaged\Routing\Condition;

class PublicResourceCondition implements Condition
{
  public function match(Context $context): bool
  {
    $resourceRoutes = [
      'favicon.ico',
      'android-chrome-192x192.png',
    ];

    return in_array(ltrim($context->request()->path(), '/'), $resourceRoutes);
  }

  public static function i(): static
  {
    return new static();
  }
}
