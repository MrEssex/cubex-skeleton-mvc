<?php

namespace MrEssex\CubexSkeleton\Tests\Mocks;

use Packaged\Dal\DalResolver;

class MockConnectionResolver extends DalResolver
{
  public function getDataStore($name)
  {
    return new MockDataStore();
  }
}
