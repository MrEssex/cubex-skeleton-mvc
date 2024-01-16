<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Example\Permissions;

use Cubex\ApiTransport\Permissions\AbstractPermission;

class ExamplePermission extends AbstractPermission
{
  public function getKey(): string
  {
    return 'example';
  }
}
