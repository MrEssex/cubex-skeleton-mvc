<?php

namespace MrEssex\CubexSkeleton\Cli;

use MrEssex\CubexCli\ConsoleCommand;
use MrEssex\CubexSkeleton\Cli\Helpers\PhinxConfig;
use Phinx\Console\Command\SeedRun as PhinxSeedRun;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SeedRun extends ConsoleCommand
{

  protected function configure()
  {
    $this->setDescription('Run database seeders')
      ->addOption('--environment', '-e', InputOption::VALUE_REQUIRED, 'The target environment', 'dev')
      ->addOption(
        '--seed',
        '-s',
        InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
        'What is the name of the seeder?'
      );
  }

  protected function executeCommand(InputInterface $input, OutputInterface $output): void
  {
    $command = new PhinxSeedRun();
    $command->setConfig(PhinxConfig::getConfig($this->getContext()));
    $command->execute($input, $output);
  }
}
