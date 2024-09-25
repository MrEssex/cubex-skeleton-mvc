<?php

namespace MrEssex\CubexSkeleton\Api;

use Cubex\ApiFoundation\Auth\ApiAuthenticator;
use Cubex\ApiFoundation\Controller\ApiController as CubexApiController;
use Cubex\ApiFoundation\Routing\ModuleRoute;
use Generator;
use MrEssex\CubexSkeleton\Api\Modules\Event\EventModule;
use Packaged\Context\Context;

class ApiController extends CubexApiController
{
  final public const VERSION = '1.0.0';

  protected function _yieldModules(): Generator|array
  {
    yield new EventModule();
  }

  protected function _generateRoutes()
  {
    foreach($this->_yieldModules() as $module)
    {
      yield ModuleRoute::withModule($module);
    }
    yield self::_route('', 'version');
  }

  public function getAuthenticator(Context $context): ApiAuthenticator
  {
    return Authenticator::withContext($context);
  }
}
