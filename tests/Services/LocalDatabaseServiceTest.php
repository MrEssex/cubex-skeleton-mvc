<?php

namespace MrEssex\CubexSkeleton\Tests\Services;

use MrEssex\CubexSkeleton\Services\DatabaseService\LocalDatabaseService;
use Packaged\Dal\Foundation\Dao;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class LocalDatabaseServiceTest extends TestCase
{
  public function testRegisterDatabaseConnections(): void
  {
    $service = new LocalDatabaseService();
    $database = $service->registerDatabaseConnections(__DIR__ . '/../../');

    $reflection = new ReflectionClass($database);
    $property = $reflection->getProperty('_configured');

    $this->assertTrue($property->getValue($database));

    $resolver = Dao::getDalResolver();
    $this->assertStringContainsString('cubex_base', $resolver->getConnectionConfig('cubex_base')->getName());
  }
}
