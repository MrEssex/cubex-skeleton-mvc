<?php

namespace MrEssex\CubexSkeleton\Api\Modules\Example;

use Cubex\ApiFoundation\Module\Module;
use Cubex\ApiFoundation\Module\Procedures\ProcedureRoute;
use Generator;
use MrEssex\CubexSkeleton\Api\Modules\Example\Procedures\CreateExample;
use MrEssex\CubexSkeletonTransport\Modules\Example\Endpoints\CreateExampleEndpoint;

class ExampleModule extends Module
{
  public function getRoutes(): Generator
  {
    yield new ProcedureRoute(new CreateExampleEndpoint(), CreateExample::class);
  }

  public static function getBasePath(): string
  {
    return 'example';
  }
}
