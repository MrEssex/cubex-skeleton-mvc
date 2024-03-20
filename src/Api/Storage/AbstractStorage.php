<?php

namespace MrEssex\CubexSkeleton\Api\Storage;

use Exception;
use Packaged\Dal\Ql\QlDao;
use Packaged\DalSchema\DalSchemaProvider;
use Packaged\Helpers\Objects;

abstract class AbstractStorage extends QlDao implements DalSchemaProvider
{
  protected $_dataStoreName = 'cubex-base';

  public mixed $id;

  public ?int $createdAt = null;

  public ?int $updatedAt = null;

  public ?int $deletedAt = null;

  public bool $active = true;

  public function save(): array
  {
    if(!$this->id)
    {
      $this->createdAt = time();
    }

    $this->updatedAt = time();
    return parent::save();
  }

  public function delete(): static
  {
    $this->deletedAt = time();
    $this->active = false;
    $this->save();

    return $this;
  }

  public function restore(): static
  {
    $this->deletedAt = null;
    $this->active = true;
    $this->save();

    return $this;
  }

  abstract protected function _apiResponseClass();

  /**
   * @throws Exception
   */
  public function toApiResponse()
  {
    return Objects::hydrate($this->_apiResponseClass(), $this);
  }
}
