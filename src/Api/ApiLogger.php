<?php

namespace MrEssex\CubexSkeleton\Api;

use Cubex\Logger\ErrorLogLogger;
use Throwable;

class ApiLogger extends ErrorLogLogger
{
  public static function formatThrowable(Throwable $e): string
  {
    return sprintf(
      "Exception message: %s%sFile: %s:%s%sTrace: %s",
      $e->getMessage(),
      PHP_EOL,
      $e->getFile(),
      $e->getLine(),
      PHP_EOL,
      preg_replace("#(\n|\r|\r\n)#s", "\n", $e->getTraceAsString())
    );
  }

  public static function asError(Throwable $message, array $context = []): void
  {
    $self = new self();
    $self->error(self::formatThrowable($message), $context);
  }
}
