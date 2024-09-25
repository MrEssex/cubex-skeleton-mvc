<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Event\Seeder;

use Faker\Factory;
use MrEssex\CubexSkeleton\Api\Modules\Event\Storage\Event;
use MrEssex\CubexSkeleton\Api\Seeder;

class EventSeeder implements Seeder
{
  public function name(): string
  {
    return 'event';
  }

  public function count(): int
  {
    return 10;
  }

  public function seed(): void
  {
    $faker = Factory::create();

    for($i = 0; $i < $this->count(); $i++)
    {
      $event = new Event();
      $event->type = $faker->randomElement(['birthday', 'wedding', 'concert', 'conference']);
      $event->save();
    }
  }
}
