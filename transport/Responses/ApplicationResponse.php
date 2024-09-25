<?php

namespace MrEssex\CubexSkeletonTransport\Responses;

use Cubex\ApiTransport\Responses\AbstractResponse;

class
ApplicationResponse extends AbstractResponse
{
  public int $id;

  public string $hashId;

  public bool $active;

  public int $createdAt;

  public ?int $updatedAt = null;

  public ?int $deletedAt = null;
}
