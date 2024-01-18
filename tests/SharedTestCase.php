<?php
namespace MrEssex\CubexSkeleton\Tests;

use Cubex\Context\Context;
use Cubex\Cubex;
use Packaged\Http\Request;
use Packaged\I18n\Translators\ReturnKeyTranslator;
use Packaged\I18n\Translators\Translator;
use PHPUnit\Framework\TestCase;

class SharedTestCase extends TestCase
{
  protected ?Cubex $_cubex = null;

  protected function _createCubex(): ?Cubex
  {
    if($this->_cubex instanceof Cubex)
    {
      return $this->_cubex;
    }

    $root = dirname(__DIR__);
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

    $cubex = new Cubex($root);
    $cubex->share(Translator::class, new ReturnKeyTranslator());

    $this->_cubex = $cubex;
    return $cubex;
  }

  protected function _testContext(Request $request = null, $env = Context::ENV_LOCAL): \Packaged\Context\Context
  {
    $cubex = $this->_createCubex();
    $ctx = new Context($request);
    $ctx->setEnvironment($env);
    $ctx = $cubex->prepareContext($ctx);
    $cubex->share(Context::class, $ctx);

    return $ctx;
  }
}
