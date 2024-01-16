<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Example\Endpoints;

use MrEssex\CubexSkeletonTransport\Modules\Example\Payloads\CreateExamplePayload;
use MrEssex\CubexSkeletonTransport\Modules\Example\Responses\ExampleResponse;

class CreateExampleEndpoint extends AbstractExampleEndpoint
{
  public function getVerb(): string
  {
    return self::VERB_POST;
  }

  public function getPayloadClass(): ?string
  {
    return CreateExamplePayload::class;
  }

  public function getResponseClass(): string
  {
    return ExampleResponse::class;
  }
}
