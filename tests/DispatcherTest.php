<?php
namespace MrEssex\CubexSkeleton\Tests;

use MrEssex\CubexSkeleton\System\Dispatcher;
use Packaged\Config\ConfigProviderInterface;
use Packaged\Context\Context;
use Packaged\Dispatch\Dispatch;
use Packaged\Dispatch\ResourceManager;
use Packaged\Dispatch\ResourceStore;
use Packaged\Helpers\ValueAs;
use Packaged\Http\Request;

class DispatcherTest extends SharedTestCase
{
  public function testHandle(): void
  {
    $ctx = $this->_testContext();
    $dispatch = Dispatcher::create($ctx);

    $request = Request::create('/_r');
    $response = $dispatch->handleRequest($request);

    self::assertEquals(404, $response->getStatusCode());
    self::assertEquals('File Not Found', $response->getContent());
  }

  public function testHandleAddResource(): void
  {
    $ctx = $this->_testContext();
    $dispatch = Dispatcher::create($ctx);

    // Add a resource
    ResourceManager::resources([], $dispatch)->requireCss('index.min.css');
    ResourceManager::resources([], $dispatch)->requireJs('index.min.js');

    $resources = array_merge(
      $dispatch->store()->getResources(ResourceStore::TYPE_CSS),
      $dispatch->store()->getResources(ResourceStore::TYPE_JS)
    );

    self::assertNotEmpty($resources);
    self::assertCount(2, $resources);
    self::assertMatchesRegularExpression('/_\/r\/r\/(.*)?\/index.min.css/', array_key_first($resources));
    self::assertMatchesRegularExpression('/_\/r\/r\/(.*)?\/index.min.js/', array_key_last($resources));
  }

  public function testCreateDefault(): void
  {
    $ctx = $this->_testContext(null, Context::ENV_PHPUNIT);
    $dispatch = Dispatcher::create($ctx);

    $aliases = $dispatch->getComponentAliases();
    self::assertIsArray($aliases);
    self::assertNotEmpty($aliases);

    $expected = [
      '_mres' => 'MrEssex\CubexSkeleton\Modules',
      '_ures' => 'MrEssex\CubexSkeleton\UI',
    ];

    self::assertEquals($expected, $aliases);

    $config = $dispatch->config();
    self::assertInstanceOf(ConfigProviderInterface::class, $config);
    self::assertNotEmpty($config);
    self::assertFalse(ValueAs::bool($config->getItem('optimisation', 'webp')));
    self::assertFalse(ValueAs::bool($config->getItem('ext.css', 'sourcemap')));
    self::assertFalse(ValueAs::bool($config->getItem('ext.js', 'sourcemap')));
  }

  public function testCreateDev(): void
  {
    $ctx = $this->_testContext();
    $dispatch = Dispatcher::create($ctx);
    $config = $dispatch->config();

    self::assertInstanceOf(ConfigProviderInterface::class, $config);
    self::assertNotEmpty($config);
    self::assertTrue(ValueAs::bool($config->getItem('optimisation', 'webp')));
    self::assertTrue(ValueAs::bool($config->getItem('ext.css', 'sourcemap')));
    self::assertTrue(ValueAs::bool($config->getItem('ext.js', 'sourcemap')));
  }

  public function testDispatchShouldNotBeGlobal(): void
  {
    $ctx = $this->_testContext();

    // Create Dispatch
    Dispatcher::create($ctx);

    self::assertEmpty(Dispatch::instance());
  }
}
