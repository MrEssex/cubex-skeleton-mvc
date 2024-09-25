<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Event\Payloads;

use Cubex\ApiTransport\Payloads\AbstractPayload;
use stdClass;

class CreateEventPayload extends AbstractPayload
{
  public ?string $n;
  public ?string $u;
  public ?string $d;
  public ?string $r;
  public ?stdClass $p;
}
