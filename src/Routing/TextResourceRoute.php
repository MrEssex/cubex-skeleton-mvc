<?php

namespace MrEssex\CubexSkeleton\Routing;

use Packaged\Context\Context;
use Packaged\Helpers\Path;
use Packaged\Http\Responses\TextResponse;
use Packaged\Routing\FuncCondition;
use Packaged\Routing\Handler\FuncHandler;
use Packaged\Routing\Route;

class TextResourceRoute extends Route
{
  public function __construct()
  {
    $this->add(FuncCondition::i(static function (Context $context) {
      $route = [
        'robots.txt',
      ];

      return in_array(ltrim($context->request()->path(), '/'), $route);
    }));
  }

  public function getHandler(): FuncHandler
  {
    return new FuncHandler(static function (Context $context) {
      $path = Path::system($context->getProjectRoot(), 'public', $context->request()->path());
      return TextResponse::create(file_get_contents($path));
    });
  }
}
