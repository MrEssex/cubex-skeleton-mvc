<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Event\Endpoints;

use MrEssex\CubexSkeletonTransport\Modules\Event\Payloads\CreateEventPayload;
use MrEssex\CubexSkeletonTransport\Modules\Event\Responses\EventResponse;
use MrEssex\CubexSkeletonTransport\Modules\Example\Endpoints\AbstractExampleEndpoint;

class CreateEventEndpoint extends AbstractEventEndpoint
{
  public function getVerb(): string
  {
    return self::VERB_POST;
  }

  public function getPayloadClass(): ?string
  {
    return CreateEventPayload::class;
  }

  public function getResponseClass(): string
  {
    return EventResponse::class;
  }
}
