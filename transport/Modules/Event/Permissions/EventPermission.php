<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Event\Permissions;

use Cubex\ApiTransport\Permissions\AbstractPermission;

class EventPermission extends AbstractPermission
{
  public function getKey(): string
  {
    return 'event';
  }
}
