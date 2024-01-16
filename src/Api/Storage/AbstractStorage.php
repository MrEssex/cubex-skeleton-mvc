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

  public ?int $created_at = null;

  public ?int $updated_at = null;

  public ?int $deleted_at = null;

  public bool $active = true;

  public function save()
  {
    if(!$this->id)
    {
      $this->created_at = time();
    }

    $this->updated_at = time();
    return parent::save();
  }

  public function delete()
  {
    $this->deleted_at = time();
    $this->active = false;
    $this->save();

    return $this;
  }

  public function restore()
  {
    $this->deleted_at = null;
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
