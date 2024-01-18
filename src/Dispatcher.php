<?php

namespace MrEssex\CubexSkeleton;

use Packaged\Context\Context;
use Packaged\Dispatch\Dispatch;
use Packaged\Routing\Handler\Handler;
use Symfony\Component\HttpFoundation\Response;

class Dispatcher implements Handler
{
  final public const DISPATCH_PATH = '/_r';

  public function __construct(public Dispatch $dispatch) { }

  public static function create(Context $ctx, string $path = '_/r'): Dispatch
  {
    $config = $ctx->config();
    $dispatch = new Dispatch($ctx->getProjectRoot(), $path);

    $dispatch->config()->addItem('optimisation', 'webp', $config->getItem('dispatch', 'opt-webp', true));
    $dispatch->config()->addItem('ext.css', 'sourcemap', $config->getItem('dispatch', 'opt-sourcemap', false));
    $dispatch->config()->addItem('ext.js', 'sourcemap', $config->getItem('dispatch', 'opt-sourcemap', false));

    $dispatch->addComponentAlias('MrEssex\\CubexSkeleton\\Modules', 'mres');
    $dispatch->addComponentAlias('MrEssex\\CubexSkeleton\\UI', 'ures');

    return $dispatch;
  }

  public function handle(Context $c): Response
  {
    return $this->dispatch->handleRequest($c->request());
  }
}
