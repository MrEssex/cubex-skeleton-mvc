<?php

namespace MrEssex\CubexSkeleton;

use Cubex\Application\Application;
use MrEssex\CubexSkeleton\Routing\ResourceRoute;
use MrEssex\CubexSkeleton\Routing\Router;
use MrEssex\CubexSkeleton\Routing\TextResourceRoute;
use MrEssex\CubexSkeleton\System\Dispatcher;
use Packaged\Context\Context;
use Packaged\Helpers\ValueAs;
use Packaged\Http\Request;
use Packaged\Http\Response;
use Packaged\Routing\Handler\Handler;
use Packaged\Routing\HealthCheckCondition;
use Packaged\Routing\Route;
use Packaged\Routing\Routes\InsecureRequestUpgradeRoute;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class MainApplication extends Application
{
  protected function _generateRoutes()
  {
    $cubex = @$this->getCubex();

    // Health check
    yield Route::with(new HealthCheckCondition())
      ->setHandler(static fn() => Response::create('OK'));

    yield self::_route(Dispatcher::DISPATCH_PATH, $cubex->resolve(Dispatcher::class));

    // Resource Routes
    yield ResourceRoute::i();

    // Text Resource Routes
    yield TextResourceRoute::i();

    $config = $this->getContext()->config();

    // Insecure request upgrade
    if(ValueAs::bool($config->getItem('serve', 'redirect_https')))
    {
      yield InsecureRequestUpgradeRoute::i();
    }

    // Trusted proxies for LB header trust
    $proxies = $config->getItem('serve', 'trusted_proxies');
    if($proxies !== null)
    {
      Request::setTrustedProxies(ValueAs::arr($proxies), Request::HEADER_X_FORWARDED_ALL);
    }

    $this->_setupApplication();

    return parent::_generateRoutes();
  }

  protected function _setupApplication(): void
  {
    $cubex = @$this->getCubex();

    // DI
    Dependencies::inject($cubex);

    // Post resolvers
    Dependencies::postResolve($cubex);
  }

  public function handle(Context $c): SymfonyResponse
  {
    $cubex = @$this->getCubex();

    // Critical DI
    Dependencies::critical($cubex);

    return parent::handle($c);
  }

  protected function _defaultHandler(): Handler
  {
    $cubex = @$this->getCubex();
    /** @var Router $router */
    $router = $cubex->resolve(Router::class);
    return $router;
  }
}
