<?php

namespace MrEssex\CubexSkeleton;

use Cubex\Context\Context;
use Cubex\Cubex;
use Cubex\CubexAware;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use MrEssex\CubexSkeleton\System\Ui\Dispatcher;
use Packaged\Context\Context as ContextAlias;
use Packaged\Dispatch\Dispatch;
use Packaged\I18n\TranslatorAware;
use Packaged\I18n\Translators\Translator;

class Dependencies
{
  public static function inject(Cubex $cubex): void
  {
    /** @var Context $ctx */
    $ctx = $cubex->getContext();
    $environment = $ctx->getEnvironment();

    // Translations
    $ctx->prepareTranslator(
      '/translations/',
      in_array($environment, [ContextAlias::ENV_LOCAL, ContextAlias::ENV_DEV], true)
    );

    // Inject env specific
    match ($environment)
    {
      ContextAlias::ENV_LOCAL, ContextAlias::ENV_DEV => self::injectDev($cubex),
      default => self::injectProd($cubex),
    };
  }

  public static function injectDev(Cubex $cubex): void
  {
  }

  public static function injectProd(Cubex $cubex): void
  {

  }

  public static function postResolve(Cubex $cubex): void
  {
    $cubex->onAfterResolve(static function ($inst) use ($cubex): void {
      if($inst instanceof TranslatorAware)
      {
        $inst->setTranslator($cubex->retrieve(Translator::class));
      }

      if($inst instanceof CubexAware)
      {
        $inst->setCubex($cubex);
      }
    });
  }

  public static function critical(Cubex $cubex): void
  {
    $cubex->share(
      Dispatch::class,
      Dispatcher::create($cubex->getContext(), Dispatcher::DISPATCH_PATH),
      Cubex::MODE_IMMUTABLE
    );
  }

  public static function bootEloquent(Cubex $cubex): Manager
  {
    $config = $cubex->getContext()->config()->getSection('eloquent');

    $capsule = new Manager();
    $capsule->addConnection([
      'driver'    => $config->getItem('driver', 'mysql'),
      'host'      => $config->getItem('host', 'localhost'),
      'database'  => $config->getItem('database', 'database'),
      'username'  => $config->getItem('username', 'root'),
      'password'  => $config->getItem('password', ''),
      'charset'   => $config->getItem('charset', 'utf8'),
      'collation' => $config->getItem('collation', 'utf8_unicode_ci'),
      'prefix'    => $config->getItem('prefix', ''),
    ]);

    // Set the event dispatcher used by Eloquent models...
    $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new Container()));

    // Make this Capsule instance available globally via static methods...
    $capsule->setAsGlobal();

    // Boot Eloquent
    $capsule->bootEloquent();

    $cubex->share(Manager::class, $capsule, Cubex::MODE_IMMUTABLE);
    $cubex->aliasAbstract(Manager::class, 'db');

    return $capsule;
  }
}
