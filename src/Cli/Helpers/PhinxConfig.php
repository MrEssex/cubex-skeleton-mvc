<?php

namespace MrEssex\CubexSkeleton\Cli\Helpers;

use MrEssex\CubexSkeleton\System\Database\Migration;
use MrEssex\CubexSkeleton\System\Database\Seeder;
use Packaged\Context\Context;
use Phinx\Config\Config;

class PhinxConfig
{
  public static function getConfig(Context $ctx): Config
  {
    $config = $ctx->config()->getSection('eloquent');
    $projectRoot = $ctx->getProjectRoot();

    return new Config([
      'seed_base_class'      => Seeder::class,
      'paths'                => [
        'migrations' => $projectRoot . '/database/migrations',
        'seeds'      => $projectRoot . '/database/seeders',
      ],
      'migration_base_class' => Migration::class,
      'environments'         => [
        'default_migration_table' => 'migrations',
        'default_database'        => 'dev',
        'dev'                     => [
          'adapter' => $config->getItem('adapter', 'mysql'),
          'host'    => $config->getItem('host', 'localhost'),
          'name'    => $config->getItem('database', 'cubex'),
          'user'    => $config->getItem('username', 'root'),
          'pass'    => $config->getItem('password', ''),
          'port'    => $config->getItem('port', 3306),
        ],
      ],
    ]);
  }
}
