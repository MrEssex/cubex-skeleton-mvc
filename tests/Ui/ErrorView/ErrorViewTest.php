<?php

namespace MrEssex\CubexSkeleton\Tests\Ui\ErrorView;

use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use MrEssex\CubexSkeleton\Ui\ErrorView\ErrorView;
use Packaged\Http\Request;

class ErrorViewTest extends SharedTestCase
{
  public function testGetBlockName()
  {
    $view = new ErrorView();
    $this->assertEquals('error', $view->getBlockName());
  }

  public function testErrorPageRenderedOnUnknownRoutes()
  {

    $request = Request::create('/error/unknown');
    $response = $this->_handleRequest($request);

    $this->assertEquals(404, $response->getStatusCode());
    $this->assertStringContainsString('<h1>404 Error Occurred</h1>', $response->getContent());
  }
}
