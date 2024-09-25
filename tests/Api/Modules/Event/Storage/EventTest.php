<?php

namespace MrEssex\CubexSkeleton\Tests\Api\Modules\Event\Storage;

use MrEssex\CubexSkeleton\Api\Modules\Event\Storage\Event;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\DalSchema\Databases\Mysql\MySQLKeyType;

class EventTest extends SharedTestCase
{
  public function testSchemaIsCorrect(): void
  {
    $example = new Event();
    $table = $example->getDaoSchema();

    // Make sure the name is plural
    $this->assertEquals('examples', $table->getName());

    // Make sure we have id as a primary key
    $keys = $table->getKeys();
    $this->assertCount(1, $keys);
    $this->assertEquals(MySQLKeyType::PRIMARY()->toUpper(), $keys[0]->getName());
    $this->assertEquals(['id'], $keys[0]->getColumns());

    // Make sure we have the default columns
    $columns = $table->getColumns();
    $this->assertCount(7, $columns);
    $this->assertEquals('id', $columns[0]->getName());
    $this->assertEquals('active', $columns[1]->getName());
    $this->assertEquals('created_at', $columns[2]->getName());
    $this->assertEquals('updated_at', $columns[3]->getName());
    $this->assertEquals('deleted_at', $columns[4]->getName());
  }
}
