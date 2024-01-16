<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Example\Payloads;

use Cubex\ApiTransport\Payloads\AbstractPayload;

class CreateExamplePayload extends AbstractPayload
{
  public string $title;

  public string $description;
}
