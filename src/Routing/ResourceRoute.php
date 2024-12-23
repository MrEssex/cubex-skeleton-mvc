<?php

namespace MrEssex\CubexSkeleton\Routing;

use Packaged\Context\Context;
use Packaged\Dispatch\Resources\ResourceFactory;
use Packaged\Helpers\Path;
use Packaged\Routing\FuncCondition;
use Packaged\Routing\Handler\FuncHandler;
use Packaged\Routing\Route;

class ResourceRoute extends Route
{
  public function __construct()
  {
    $this->add(FuncCondition::i(static function (Context $context): bool {
      $route = [
        'favicon.ico',
      ];

      return in_array(ltrim($context->request()->path(), '/'), $route);
    }));
  }

  public function getHandler(): FuncHandler
  {
    return new FuncHandler(static function (Context $context) {
      $path = Path::system($context->getProjectRoot(), 'public', $context->request()->path());

      if(!file_exists($path))
      {
        return null;
      }

      return ResourceFactory::fromFile($path);
    });
  }
}
