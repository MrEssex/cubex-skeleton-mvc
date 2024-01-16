<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Example\Endpoints;

use Cubex\ApiTransport\Endpoints\AbstractEndpoint;
use MrEssex\CubexSkeleton\Api\Modules\Example\ExampleModule;
use MrEssex\CubexSkeletonTransport\Modules\Example\Permissions\ExamplePermission;

abstract class AbstractExampleEndpoint extends AbstractEndpoint
{
  public function getPath(): string
  {
    return ExampleModule::getBasePath();
  }

  public function requiresAuthentication(): bool
  {
    return false;
  }

  public function getRequiredPermissions(): array
  {
    return [
      new ExamplePermission(),
    ];
  }
}
