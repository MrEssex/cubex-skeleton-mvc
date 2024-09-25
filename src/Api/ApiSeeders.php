<?php

namespace MrEssex\CubexSkeleton\Api;

use MrEssex\CubexSkeleton\Api\Modules\Event\Seeder\EventSeeder;

class ApiSeeders
{
  public function getSeeders(): array
  {
    return [
      new EventSeeder(),
    ];
  }
}
