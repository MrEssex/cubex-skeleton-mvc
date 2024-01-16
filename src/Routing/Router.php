<?php

namespace MrEssex\CubexSkeleton\Routing;

use MrEssex\CubexSkeleton\Api\ApiController;
use MrEssex\CubexSkeleton\Modules\HomeModule\HomeModule;
use MrEssex\CubexSkeleton\Modules\Module;
use MrEssex\CubexSkeleton\Ui\Layout\LayoutController;

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

    yield self::_route('/api/v1', ApiController::class);

    // Handle modules
    foreach($this->_getModules() as $module)
    {
      yield self::_route('/' . $module->baseRoute(), static function () use ($cubex, $module) {
        $module->setup($cubex);
        return $cubex->resolve($module->defaultHandlerString());
      });
    }
  }
}
