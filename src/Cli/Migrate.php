<?php

namespace MrEssex\CubexSkeleton\Cli;

use MrEssex\CubexCli\ConsoleCommand;
use MrEssex\CubexSkeleton\Cli\Helpers\PhinxConfig;
use Phinx\Console\Command\Migrate as PhinxMigrate;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate extends ConsoleCommand
{
  protected function configure(): void
  {
    $this->setDescription('Migrate the database')
      ->addOption('--environment', '-e', InputOption::VALUE_REQUIRED, 'The target environment', 'dev')
      ->addOption('--target', '-t', InputOption::VALUE_REQUIRED, 'The version number to migrate to')
      ->addOption('--date', '-d', InputOption::VALUE_REQUIRED, 'The date to migrate to')
      ->addOption('--dry-run', '-x', InputOption::VALUE_NONE, 'Dump query to standard output instead of executing it')
      ->addOption(
        '--fake',
        null,
        InputOption::VALUE_NONE,
        "Mark any migrations selected as run, but don't actually execute them"
      );
  }

  protected function executeCommand(InputInterface $input, OutputInterface $output): void
  {
    $command = new PhinxMigrate();
    $command->setConfig(PhinxConfig::getConfig($this->getContext()));
    $command->execute($input, $output);
  }
}
