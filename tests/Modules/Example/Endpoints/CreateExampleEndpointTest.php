<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\Example\Endpoints;

use MrEssex\CubexSkeletonTransport\Modules\Example\Endpoints\CreateExampleEndpoint;
use MrEssex\CubexSkeletonTransport\Modules\Example\Payloads\CreateExamplePayload;
use MrEssex\CubexSkeletonTransport\Modules\Example\Responses\ExampleResponse;
use PHPUnit\Framework\TestCase;

class CreateExampleEndpointTest extends TestCase
{
  public function testGetVerb(): void
  {
    $endpoint = new CreateExampleEndpoint();
    $this->assertEquals('POST', $endpoint->getVerb());
  }

  public function testGetResponseClass(): void
  {
    $endpoint = new CreateExampleEndpoint();
    $this->assertEquals(ExampleResponse::class, $endpoint->getResponseClass());
  }

  public function testGetPayloadClass(): void
  {
    $endpoint = new CreateExampleEndpoint();
    $this->assertEquals(CreateExamplePayload::class, $endpoint->getPayloadClass());
  }
}
