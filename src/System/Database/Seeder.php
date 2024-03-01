<?php

namespace MrEssex\CubexSkeleton\System\Database;

use Cubex\Cubex;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Capsule\Manager;
use MrEssex\CubexSkeleton\Dependencies;
use Packaged\Rwd\Language\LanguageCode;
use Phinx\Seed\AbstractSeed;

class Seeder extends AbstractSeed
{
  public ?Generator $faker = null;
  public ?Manager $capsule = null;

  public function init(): void
  {
    $projectRoot = dirname(__DIR__, 3);
    $loader = require($projectRoot . '/vendor/autoload.php');

    $capsule = Dependencies::bootEloquent(new Cubex($projectRoot, $loader, false));

    $this->capsule = $capsule;
    $this->faker = Factory::create(LanguageCode::EN);
  }

  public function seedDates(array $table)
  {
    $faker = $this->faker;

    $dates = [
      'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
      'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
    ];

    return array_merge($table, $dates);
  }
}
