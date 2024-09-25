<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Event\Storage;

use MrEssex\CubexSkeleton\Api\Storage\AbstractStorage;
use MrEssex\CubexSkeleton\Api\Storage\StorageTable;
use MrEssex\CubexSkeletonTransport\Modules\Event\Responses\EventResponse;
use Packaged\DalSchema\Databases\Mysql\MySQLColumn;
use Packaged\DalSchema\Databases\Mysql\MySQLColumnType;
use Packaged\DalSchema\Databases\Mysql\MySQLKey;
use Packaged\DalSchema\Databases\Mysql\MySQLKeyType;
use Packaged\DalSchema\Table;

class Event extends AbstractStorage
{
  public ?string $ip = null;
  public ?string $page = null;
  public ?string $type = null;

  protected function _apiResponseClass(): EventResponse
  {
    return new EventResponse();
  }

  public function getDaoSchema(): Table
  {
    $tbl = new StorageTable($this->getTableName());
    $tbl->addColumn(
      new MySQLColumn('ip', MySQLColumnType::VARCHAR(), 16, false),
      new MySQLColumn('page', MySQLColumnType::VARCHAR(), 255, false),
      new MySQLColumn('type', MySQLColumnType::VARCHAR(), 255, false)
    );

    $tbl->addKey(new MySQLKey('ip', MySQLKeyType::INDEX(), 'ip'));
    $tbl->addKey(new MySQLKey('page', MySQLKeyType::INDEX(), 'page'));
    return $tbl;
  }
}
