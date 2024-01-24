<?php

namespace MrEssex\CubexSkeleton;

use Cubex\Context\Context;
use Cubex\Cubex;
use Cubex\CubexAware;
use MrEssex\CubexSkeleton\Services\Interfaces\DatabaseService;
use MrEssex\CubexSkeleton\Services\LocalDatabaseService;
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

    // Share if not already shared
    if(!$cubex->isAvailable(DatabaseService::class))
    {
      // Database
      self::_injectDatabase($cubex);
    }

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

  protected static function _injectDatabase(Cubex $cubex): void
  {
    /** @var Context $ctx */
    $ctx = $cubex->getContext();

    // Database
    $database = new LocalDatabaseService();
    $database->registerDatabaseConnections($ctx->getProjectRoot(), $ctx->getEnvironment());

    $cubex->share(LocalDatabaseService::class, $database);
  }
}
