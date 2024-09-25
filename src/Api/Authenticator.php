<?php

namespace MrEssex\CubexSkeleton\Api;

use Cubex\ApiFoundation\Auth\ApiAuthenticator;
use Cubex\ApiTransport\Permissions\ApiPermission;
use Packaged\Context\Conditions\ExpectEnvironment;

class Authenticator extends ApiAuthenticator
{
  public function isAuthenticated(): bool
  {
    return true;
  }

  public function hasPermission(ApiPermission ...$permission): bool
  {
    // Default to true for local
    if($this->getContext()->matches(ExpectEnvironment::local()))
    {
      return true;
    }

    // foreach($permission as $p)
    // {
    // Get User Permissions
    // If user has permission, return true for that permission
    // if all allowed, return true
    // }

    return parent::hasPermission(...$permission);
  }
}

