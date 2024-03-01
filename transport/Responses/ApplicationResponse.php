<?php

namespace MrEssex\CubexSkeletonTransport\Responses;

use Cubex\ApiTransport\Responses\AbstractResponse;

class
ApplicationResponse extends AbstractResponse
{
  public mixed $id;

  public string $created_at;

  public ?string $updated_at = null;

  public ?int $deleted_at = null;
}
