<?php

namespace MrEssex\CubexSkeleton\Services\DatabaseService;

use Packaged\Config\Provider\Ini\IniConfigProvider;
use Packaged\Dal\DalResolver;

class LocalDatabaseService implements DatabaseService
{
  protected bool $_configured = false;

  public function registerDatabaseConnections(string $projectRoot, string $environment = 'local'): static
  {
    if(!$this->_configured)
    {
      $this->_configured = true;
      $dal = new DalResolver(
        (new IniConfigProvider())->loadFiles(
          [
            $projectRoot . "/conf/connections.ini",
            $projectRoot . sprintf('/conf/%s/connections.ini', $environment),
          ]
        ),
        (new IniConfigProvider())->loadFiles(
          [
            $projectRoot . "/conf/datastores.ini",
            $projectRoot . sprintf('/conf/%s/datastores.ini', $environment),
          ]
        ),
      );
      $dal->boot();
    }

    return $this;
  }
}
