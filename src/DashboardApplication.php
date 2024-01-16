<?php

namespace MrEssex\CubexSkeleton;

use Cubex\Application\Application;
use MrEssex\CubexSkeleton\Routing\PublicResourceCondition;
use MrEssex\CubexSkeleton\Routing\PublicTextResourceCondition;
use MrEssex\CubexSkeleton\Routing\Router;
use Packaged\Context\Context;
use Packaged\Dispatch\Resources\ResourceFactory;
use Packaged\Helpers\ValueAs;
use Packaged\Http\Request;
use Packaged\Http\Response;
use Packaged\Http\Responses\TextResponse;
use Packaged\Routing\Handler\Handler;
use Packaged\Routing\HealthCheckCondition;
use Packaged\Routing\Route;
use Packaged\Routing\Routes\InsecureRequestUpgradeRoute;

class DashboardApplication extends Application
{
  protected function _generateRoutes()
  {
    $cubex = @$this->getCubex();

    // Health check
    yield Route::with(new HealthCheckCondition())->setHandler(static fn() => Response::create('OK'));

    yield self::_route(Dispatcher::DISPATCH_PATH, $cubex->resolve(Dispatcher::class));

    // Public resources
    yield Route::with(PublicResourceCondition::i())->setHandler(static function () use ($cubex) {
        $context = $cubex->getContext();
        return ResourceFactory::fromFile(
          $context->getProjectRoot() . '/public' . $context->request()->path()
        );
    });

    // Public text resources
    yield Route::with(PublicTextResourceCondition::i())->setHandler(static function () use ($cubex) {
        $context = $cubex->getContext();
        return TextResponse::create(
          file_get_contents($context->getProjectRoot() . '/public' . $context->request()->path())
        );
    });

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

  protected function _initApplication(): void
  {

  }

  protected function _setupApplication(): void
  {
    $cubex = @$this->getCubex();

    // DI
    Dependencies::inject($cubex);

    // Post resolvers
    Dependencies::postResolve($cubex);
  }

  public function handle(Context $c): \Symfony\Component\HttpFoundation\Response
  {
    $cubex = @$this->getCubex();

    // Critical DI
    Dependencies::critical($cubex);

    return parent::handle($c);
  }

  protected function _defaultHandler(): Handler
  {
    /** @var Router $router */
    $router = $this->getCubex()->resolve(Router::class);
    return $router;
  }
}
