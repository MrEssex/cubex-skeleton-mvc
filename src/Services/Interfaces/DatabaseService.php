<?php

namespace MrEssex\CubexSkeleton\Services\Interfaces;

interface DatabaseService
{
  public function registerDatabaseConnections(string $projectRoot, string $environment = 'local'): static;
}
