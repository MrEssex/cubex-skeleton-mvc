<?php

namespace MrEssex\CubexSkeleton\Routing;

use MrEssex\CubexSkeleton\Api\ApiController;
use MrEssex\CubexSkeleton\Modules\HomeModule\HomeModule;
use MrEssex\CubexSkeleton\Modules\Module;
use MrEssex\CubexSkeleton\System\Layout\LayoutController;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;

class Router extends LayoutController
{
  /**
   * @return Module[]
   */
  protected function _getModules(): array
  {
    return [
      new HomeModule(),
    ];
  }

  protected function _generateRoutes()
  {
    $cubex = $this->_cubex();

    // Handle Api
    yield self::_route('/api/v1', ApiController::class);

    // Handle Website Modules
    foreach($this->_getModules() as $module)
    {
      yield self::_route('/' . $module->baseRoute(), static function () use ($cubex, $module) {
        // Defaults
        /** @var Dispatch $dispatch */
        $dispatch = $cubex->retrieve(Dispatch::class);
        ResourceManager::resources([], $dispatch)->requireJs('analytics.min.js');

        $module->setup($cubex);

        return $cubex->resolve($module->defaultHandlerString());
      });
    }
  }
}
