<?php

namespace MrEssex\CubexSkeleton\Api;

use Cubex\ApiFoundation\Auth\ApiAuthenticator;
use Cubex\ApiFoundation\Controller\ApiController as CubexApiController;
use Generator;
use MrEssex\CubexSkeleton\Api\Authenticator\Authenticator;
use MrEssex\CubexSkeleton\Api\Modules\Example\ExampleModule;
use Packaged\Context\Context;

class ApiController extends CubexApiController
{
  final public const VERSION = '1.0.0';

  protected function _yieldModules(): Generator|array
  {
    yield new ExampleModule();
  }

  public function getAuthenticator(Context $context): ApiAuthenticator
  {
    return Authenticator::withContext($context);
  }
}
