<?php

namespace MrEssex\CubexSkeleton\Api\Storage;

use Exception;
use Packaged\Dal\Ql\QlDao;
use Packaged\DalSchema\DalSchemaProvider;
use Packaged\Helpers\Objects;

abstract class AbstractStorage extends QlDao implements DalSchemaProvider
{
  protected $_dataStoreName = 'cubex-base';

  public ?int $id = null;

  public ?string $hashId = null;

  public ?int $createdAt = null;

  public ?int $updatedAt = null;

  public ?int $deletedAt = null;

  public bool $active = true;

  protected array $_guarded = [];

  public function save(): array
  {
    if(!$this->id)
    {
      $this->createdAt = time();
    }

    if(!$this->hashId)
    {
      $this->hashId = $this->_generateHashId();
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
    $return = Objects::hydrate($this->_apiResponseClass(), $this);

    $guarded = array_merge(['id'], $this->_guarded);
    foreach($guarded as $guard)
    {
      if(property_exists($return, $guard))
      {
        unset($return->$guard);
      }
    }

    return $return;
  }

  protected function _generateHashId(): string
  {
    do
    {
      $id = $this->_generateId(11);
      try
      {
        /** @var static|null $dao */
        $dao = static::loadOneWhere(['id' => $id]);
        $unique = $dao === null;
      }
      catch(Exception)
      {
        $unique = false;
      }
    }
    while($unique === false);

    return $id;
  }

  protected function _generateId(int $length): string
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for($i = 0; $i < $length; $i++)
    {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
  }
}
