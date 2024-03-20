<?php

namespace MrEssex\CubexSkeleton\Tests\Api\Modules\Example;

use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\Http\Request;

class ExampleModuleTest extends SharedTestCase
{
  public function testCanCreateExample(): void
  {
    $request = Request::create(
      '/api/v1/example',
      'POST',
      [],
      [],
      [],
      [],
      '{"title":"This is a title", "description":"This is a description"}'
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

    // assert string contains title and description as json
    $this->assertStringContainsString('"title":"This is a title"', $res->getContent());
    $this->assertStringContainsString('"description":"This is a description"', $res->getContent());

    // ID should be null
    $this->assertStringContainsString('"id":null', $res->getContent());
  }
}
