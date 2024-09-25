<?php

namespace MrEssex\CubexSkeleton\Tests\Api\Modules\Event;

use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\Http\Request;

class EventModuleTest extends SharedTestCase
{
  public function testCanCreateExample(): void
  {
    $request = Request::create(
      '/api/v1/event',
      'POST',
      [],
      [],
      [],
      [],
      '{"n":"pageview"}' // Content
    );

    $requestStart = time();
    $res = $this->_handleRequest($request);
    $requestEnd = time();

    // json response
    $this->assertEquals(200, $res->getStatusCode());

    // expect response to be valid json object
    $this->assertJson($res->getContent());

    // assert created_at is within between request start and end
    $createdAt = @preg_match('/"created_at":(\d+)/', (string)$res->getContent(), $matches) ? (int)$matches[1] : null;
    $this->assertGreaterThanOrEqual($requestStart, $createdAt);
    $this->assertLessThanOrEqual($requestEnd, $createdAt);

    // assert deleted_at is null
    $this->assertStringContainsString('"deleted_at":null', $res->getContent());

    // assert updated_at is within between request start and end
    $updatedAt = @preg_match('/"updated_at":(\d+)/', (string)$res->getContent(), $matches) ? (int)$matches[1] : null;
    $this->assertGreaterThanOrEqual($requestStart, $updatedAt);
    $this->assertLessThanOrEqual($requestEnd, $updatedAt);

    // ID should be null
    $this->assertStringContainsString('"id":null', $res->getContent());
  }
}
