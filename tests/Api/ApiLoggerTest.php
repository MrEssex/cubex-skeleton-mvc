<?php

namespace MrEssex\CubexSkeleton\Tests\Api;

use MrEssex\CubexSkeleton\Api\ApiLogger;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use PHPUnit\Framework\TestCase;

class ApiLoggerTest extends SharedTestCase
{
  public function testFormatThrowable()
  {
    $throwable = new \Exception('Test Exception');
    $formatted = ApiLogger::formatThrowable($throwable);

    $this->assertStringContainsString('Exception message: Test Exception', $formatted);
    $this->assertStringContainsString('File: ', $formatted);
    $this->assertStringContainsString('Trace: ', $formatted);
  }

  public function testAsError()
  {
    $throwable = new \Exception('Test Exception');
    $this->errorLogStartListening();

    ApiLogger::asError($throwable);

    $log = $this->errorLogGetContents();
    $this->assertStringContainsString('Exception message: Test Exception', $log);
  }
}
