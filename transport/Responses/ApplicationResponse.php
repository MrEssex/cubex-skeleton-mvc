<?php

namespace MrEssex\CubexSkeletonTransport\Responses;

use Cubex\ApiTransport\Responses\AbstractResponse;

class
ApplicationResponse extends AbstractResponse
{
  public mixed $id;

  public bool $active;

  public int $created_at;

  public ?int $updated_at = null;

  public ?int $deleted_at = null;
}
