<?php

namespace MrEssex\CubexSkeletonTransport\Modules\Event\Payloads;

use Cubex\ApiTransport\Payloads\AbstractPayload;
use stdClass;

class CreateEventPayload extends AbstractPayload
{
  public ?string $n = null;
  public ?string $u = null;
  public ?string $d = null;
  public ?string $r = null;
  public ?stdClass $p = null;
}
