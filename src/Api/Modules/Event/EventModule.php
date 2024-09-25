<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Event;

use Cubex\ApiFoundation\Module\Module;
use Cubex\ApiFoundation\Module\Procedures\ProcedureRoute;
use Generator;
use MrEssex\CubexSkeleton\Api\Modules\Event\Procedures\CreateEvent;
use MrEssex\CubexSkeletonTransport\Modules\Event\Endpoints\CreateEventEndpoint;

class EventModule extends Module
{
  public function getRoutes(): Generator
  {
    yield new ProcedureRoute(new CreateEventEndpoint(), CreateEvent::class);
  }

  public static function getBasePath(): string
  {
    return 'event';
  }
}
