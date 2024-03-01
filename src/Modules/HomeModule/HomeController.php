<?php

namespace MrEssex\CubexSkeleton\Modules\HomeModule;

use MrEssex\CubexSkeleton\Modules\HomeModule\Views\HomeView\HomeView;
use MrEssex\CubexSkeleton\Modules\HomeModule\Views\ListView\ListView;
use MrEssex\CubexSkeleton\System\Layout\LayoutController;

class HomeController extends LayoutController
{
  protected function _generateRoutes()
  {
    yield self::_route('list', 'list');

    // We declare the default route as follows, so we can still catch errors, remove $ to go to dash on error
    yield self::_route('$', 'default');
  }

  public function getDefault(): HomeView
  {
    /** @var HomeView $homeView */
    $homeView = $this->_cubex()->resolve(HomeView::class);
    return $homeView;
  }

  public function getList(): ListView
  {
    /** @var ListView $listView */
    $listView = $this->_cubex()->resolve(ListView::class);

    return $listView;
  }
}
