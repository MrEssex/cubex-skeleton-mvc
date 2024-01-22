<?php

namespace MrEssex\CubexSkeleton\Tests\Modules\HomeModule;

use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\Http\Request;

class HomeControllerTest extends SharedTestCase
{
  public function testGetHomeRoute()
  {
    $request = Request::create('/');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('This is the Home View', $response->getContent());
  }

  public function testGetListRoute()
  {
    $request = Request::create('/list');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('This is the List View', $response->getContent());
  }
}
