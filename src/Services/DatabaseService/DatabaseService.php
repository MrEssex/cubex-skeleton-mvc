<?php

namespace MrEssex\CubexSkeleton\Services\DatabaseService;

interface DatabaseService
{
  public function registerDatabaseConnections(string $projectRoot, string $environment = 'local'): static;
}
