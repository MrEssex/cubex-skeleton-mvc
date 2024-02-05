<?php

define('PHP_START', microtime(true));

use Composer\Autoload\ClassLoader;
use Cubex\Cubex;
use MrEssex\CubexSkeleton\MainApplication;
use Packaged\Context\Conditions\ExpectEnvironment;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$projectRoot = dirname(__DIR__);

/** @var ClassLoader $loader */
$loader = require($projectRoot . '/vendor/autoload.php');

try
{
  $cubex = new Cubex($projectRoot, $loader);
  $cubex->handle(new MainApplication($cubex));
}
catch(Throwable $throwable)
{
  if($cubex->getContext()->matches(ExpectEnvironment::local()))
  {
    $handler = new Run();
    $handler->pushHandler(new PrettyPageHandler());
    $handler->handleException($throwable);
  }
  else
  {
    die('Unable to handle your request');
  }
}
finally
{
  $cubex->shutdown();
}
