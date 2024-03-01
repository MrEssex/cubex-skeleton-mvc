<?php

namespace MrEssex\CubexSkeleton\Cli;

use MrEssex\CubexCli\ConsoleCommand;
use MrEssex\CubexSkeleton\Cli\Helpers\PhinxConfig;
use Phinx\Console\Command\SeedCreate as PhinxSeedCreate;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SeedCreate extends ConsoleCommand
{

  protected function configure(): void
  {
    $this->setDescription('Create a new database seeder')
      ->addArgument('name', InputArgument::REQUIRED, 'What is the name of the seeder?')
      ->addOption('--environment', '-e', InputOption::VALUE_REQUIRED, 'The target environment', 'dev')
      ->addOption('path', null, InputOption::VALUE_REQUIRED, 'Specify the path in which to create this seeder')
      ->setHelp(
        sprintf(
          '%sCreates a new database seeder%s',
          PHP_EOL,
          PHP_EOL
        )
      );

    // An alternative template.
    $this->addOption('template', 't', InputOption::VALUE_REQUIRED, 'Use an alternative template');
  }

  protected function executeCommand(InputInterface $input, OutputInterface $output): void
  {
    $command = new PhinxSeedCreate();
    $command->setConfig(PhinxConfig::getConfig($this->getContext()));
    $command->execute($input, $output);
  }
}
