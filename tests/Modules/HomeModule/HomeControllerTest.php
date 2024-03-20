<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\HomeModule;

use Cubex\Context\Context;
use MrEssex\CubexSkeleton\Modules\HomeModule\HomeController;
use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\Http\Request;

class HomeControllerTest extends SharedTestCase
{
  public function testGetHomeRoute(): void
  {
    $request = Request::create('/');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('This is the Home View', $response->getContent());
  }

  public function testGetListRoute(): void
  {
    $request = Request::create('/list');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('This is the List View', $response->getContent());
  }

  /**
   * Does the same as testGetListRoute, but uses the controller to handle the route
   * instead of going through the entire application stack.
   */
  public function testGetListRouteViaController(): void
  {
    $response = $this->_handleControllerRoute('/list', HomeController::class);
    $this->assertStringContainsString('This is the List View', $response->getContent());
  }

  protected function _handleControllerRoute(string $uri, string $controllerClass)
  {
    /** @var Context $context */
    $context = $this->_testContext(Request::create($uri));
    $cubex = $context->getCubex();

    $controller = $cubex->resolve($controllerClass);
    $controller->setContext($context);

    return $controller->handle($context);
  }
}
