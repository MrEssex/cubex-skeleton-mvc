<?php
namespace MrEssex\CubexSkeleton\Tests;

use Cubex\Context\Context;
use Cubex\Cubex;
use MrEssex\CubexSkeleton\MainApplication;
use MrEssex\CubexSkeleton\Services\DatabaseService\DatabaseService;
use MrEssex\CubexSkeleton\System\Dispatcher;
use MrEssex\CubexSkeleton\Tests\Mocks\MockDatabaseService;
use Packaged\DiContainer\DependencyInjector;
use Packaged\Dispatch\Dispatch;
use Packaged\Http\Request;
use Packaged\I18n\Translators\ReturnKeyTranslator;
use Packaged\I18n\Translators\Translator;
use PHPUnit\Framework\TestCase;

class SharedTestCase extends TestCase
{
  public $errorLogLocationBackup = "";
  public $errorLogTmpfile = "";

  protected function _createCubex(Request $request = null, string $env = Context::ENV_LOCAL): ?Cubex
  {
    $ctx = new Context($request);
    $ctx->setEnvironment($env);

    $root = dirname(__DIR__);
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

    $cubex = new Cubex($root);
    $ctx = $cubex->prepareContext($ctx);

    $cubex->share(\Packaged\Context\Context::class, $ctx);
    $cubex->share(Translator::class, new ReturnKeyTranslator());

    $databaseService = new MockDatabaseService();
    $databaseService->registerDatabaseConnections($root, $env);
    $cubex->share(DatabaseService::class, $databaseService);

    $cubex->share(
      Dispatch::class,
      Dispatcher::create($ctx, Dispatcher::DISPATCH_PATH),
      DependencyInjector::MODE_IMMUTABLE
    );

    return $cubex;
  }

  protected function _testContext(Request $request = null, string $env = Context::ENV_LOCAL): \Packaged\Context\Context
  {
    return $this->_createCubex($request, $env)->getContext();
  }

  protected function _handleRequest(Request $request)
  {
    $cubex = $this->_createCubex($request);
    return $cubex->handle(new MainApplication($cubex), false);
  }

  public function errorLogStartListening(): void
  {

    $this->errorLogTmpfile = tmpfile();
    $streamUri = stream_get_meta_data($this->errorLogTmpfile)['uri'];
    $this->errorLogLocationBackup = ini_set('error_log', $streamUri);
  }

  public function errorLogGetContents(): false|string
  {

    ini_set('error_log', $this->errorLogLocationBackup);
    return stream_get_contents($this->errorLogTmpfile);
  }
}
