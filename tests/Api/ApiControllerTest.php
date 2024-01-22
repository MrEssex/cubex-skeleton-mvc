<?php

namespace MrEssex\CubexSkeleton\Tests\Api;

use MrEssex\CubexSkeleton\Tests\SharedTestCase;
use Packaged\Http\Request;

class ApiControllerTest extends SharedTestCase
{
  public function testReturnsVersionOnInvalidModule(): void
  {
    $request = Request::create('/api/v1/something/error');
    $res = $this->_handleRequest($request);

    $this->assertStringEqualsStringIgnoringLineEndings('"1.0.0"', $res->getContent());
  }
}
