<?php

namespace MrEssex\CubexSkeleton\Api\Storage;

use Packaged\DalSchema\Databases\Mysql\MySQLColumn;
use Packaged\DalSchema\Databases\Mysql\MySQLColumnType;
use Packaged\DalSchema\Databases\Mysql\MySQLKey;
use Packaged\DalSchema\Databases\Mysql\MySQLKeyType;
use Packaged\DalSchema\Databases\Mysql\MySQLTable;

class StorageTable extends MySQLTable
{
  public function __construct(string $name)
  {
    parent::__construct($name, '');
    $this->addColumn(
      new MySQLColumn('id', MySQLColumnType::INT_UNSIGNED(), null, false, null, MySQLColumn::EXTRA_AUTO_INCREMENT),
      new MySQLColumn('hashId', MySQLColumnType::VARCHAR(), 11, true),
      new MySQLColumn('active', MySQLColumnType::TINY_INT_UNSIGNED(), 1, false, 1),
      new MySQLColumn('createdAt', MySQLColumnType::INT_UNSIGNED(), 11),
      new MySQLColumn('updatedAt', MySQLColumnType::INT_UNSIGNED(), 11, true),
      new MySQLColumn('deletedAt', MySQLColumnType::INT_UNSIGNED(), 11, true)
    );

    $this->addKey(new MySQLKey('id', MySQLKeyType::PRIMARY(), 'id'));
    $this->addKey(new MySQLKey('hashId', MySQLKeyType::UNIQUE(), 'hashId'));
  }
}
