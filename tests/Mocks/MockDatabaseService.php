<?php

namespace MrEssex\CubexSkeleton\Tests\Mocks;

use MrEssex\CubexSkeleton\Services\Interfaces\DatabaseService;
use Packaged\Dal\Foundation\Dao;

class MockDatabaseService implements DatabaseService
{
  public function registerDatabaseConnections(string $projectRoot, string $environment = 'local'): static
  {
    Dao::setDalResolver(new MockConnectionResolver());
    return $this;
  }
}
