<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\Event\Permissions;

use MrEssex\CubexSkeletonTransport\Modules\Event\Permissions\EventPermission;
use PHPUnit\Framework\TestCase;

class EventPermissionTest extends TestCase
{
  public function testGetKey(): void
  {
    $permission = new EventPermission();
    $this->assertEquals('event', $permission->getKey());
  }
}
