<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\Example\Permissions;

use MrEssex\CubexSkeletonTransport\Modules\Example\Permissions\ExamplePermission;
use PHPUnit\Framework\TestCase;

class ExamplePermissionTest extends TestCase
{
  public function testGetKey()
  {
    $permission = new ExamplePermission();
    $this->assertEquals('example', $permission->getKey());
  }
}
