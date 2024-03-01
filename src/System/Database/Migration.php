<?php

namespace MrEssex\CubexSkeleton\System\Database;

use Cubex\Cubex;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Builder;
use MrEssex\CubexSkeleton\Dependencies;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
  public ?Builder $schema = null;

  public function init(): void
  {
    $projectRoot = dirname(__DIR__, 3);
    $loader = require($projectRoot . '/vendor/autoload.php');

    Dependencies::bootEloquent(new Cubex($projectRoot, $loader, false));

    $this->schema = Manager::schema();
  }
}
