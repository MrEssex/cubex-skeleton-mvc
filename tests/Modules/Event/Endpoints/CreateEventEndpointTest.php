<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\Event\Endpoints;

use MrEssex\CubexSkeletonTransport\Modules\Event\Endpoints\CreateEventEndpoint;
use MrEssex\CubexSkeletonTransport\Modules\Event\Payloads\CreateEventPayload;
use MrEssex\CubexSkeletonTransport\Modules\Event\Responses\EventResponse;
use PHPUnit\Framework\TestCase;

class CreateEventEndpointTest extends TestCase
{
  public function testGetVerb(): void
  {
    $endpoint = new CreateEventEndpoint();
    $this->assertEquals('POST', $endpoint->getVerb());
  }

  public function testGetResponseClass(): void
  {
    $endpoint = new CreateEventEndpoint();
    $this->assertEquals(EventResponse::class, $endpoint->getResponseClass());
  }

  public function testGetPayloadClass(): void
  {
    $endpoint = new CreateEventEndpoint();
    $this->assertEquals(CreateEventPayload::class, $endpoint->getPayloadClass());
  }
}
