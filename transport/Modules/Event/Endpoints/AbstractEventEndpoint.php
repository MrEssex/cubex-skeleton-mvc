<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Event\Endpoints;

use Cubex\ApiTransport\Endpoints\AbstractEndpoint;
use MrEssex\CubexSkeleton\Api\Modules\Event\EventModule;
use MrEssex\CubexSkeletonTransport\Modules\Event\Permissions\EventPermission;

abstract class AbstractEventEndpoint extends AbstractEndpoint
{
  public function getPath(): string
  {
    return EventModule::getBasePath();
  }

  public function requiresAuthentication(): bool
  {
    return false;
  }

  public function getRequiredPermissions(): array
  {
    return [
      new EventPermission(),
    ];
  }
}
