<?php

namespace MrEssex\CubexSkeleton\Cli;

use Exception;
use MrEssex\CubexCli\ConsoleCommand;
use MrEssex\CubexSkeleton\Api\ApiSeeders;
use MrEssex\CubexSkeleton\Api\Seeder;
use MrEssex\CubexSkeleton\Services\DatabaseService\LocalDatabaseService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Seed extends ConsoleCommand
{
  /**
   * @throws Exception
   */
  public function executeCommand(InputInterface $input, OutputInterface $output): void
  {
    $seeders = (new ApiSeeders())->getSeeders();
    $ctx = $this->getContext();
    $service = new LocalDatabaseService();
    $service->registerDatabaseConnections($ctx->getProjectRoot(), $ctx->getEnvironment());

    /** @var Seeder $seeder */
    foreach($seeders as $seeder)
    {
      $this->_output->writeln('Seeding ' . $seeder->name());
      $seeder->seed();
      $this->_output->writeln('Finished Seeding ' . $seeder->name());
    }
  }
}
