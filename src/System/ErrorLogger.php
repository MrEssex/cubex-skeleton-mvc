<?php

namespace MrEssex\CubexSkeleton\System;

use Cubex\Logger\ErrorLogLogger;

class ErrorLogger extends ErrorLogLogger
{
  public static function i(): self
  {
    return new self();
  }

  public static function formatThrowable(\Throwable $t): string
  {
    return sprintf(
      "Exception message: %s%sFile: %s:%s%sTrace: %s",
      $t->getMessage(),
      PHP_EOL,
      $t->getFile(),
      $t->getLine(),
      PHP_EOL,
      preg_replace("#(\n|\r|\r\n)#", "\n", $t->getTraceAsString())
    );
  }

  public static function exception(\Throwable $e, string $message = '', array $context = []): void
  {
    static::i()->error($message . ' - ' . $e->getMessage(), $context);
  }
}
