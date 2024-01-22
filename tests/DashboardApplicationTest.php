<?php

namespace MrEssex\CubexSkeleton\Tests;

use Packaged\Http\Request;

class DashboardApplicationTest extends SharedTestCase
{
  public function testGetPublicResource(): void
  {
    $request = Request::create('/favicon.ico');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals('image/x-icon', $response->headers->get('Content-Type'));
  }

  public function testGetPublicTextResource(): void
  {
    $request = Request::create('/robots.txt');
    $response = $this->_handleRequest($request);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertStringContainsString('// Robots.txt', $response->getContent());
  }
}
