<?php

namespace MrEssex\CubexSkeleton\Cli;

use Exception;
use MrEssex\CubexCli\ConsoleCommand;
use MrEssex\CubexSkeleton\Services\DatabaseService\LocalDatabaseService;
use Packaged\Dal\Exceptions\DalResolver\ConnectionNotFoundException;
use Packaged\Dal\Exceptions\DalResolver\DataStoreNotFoundException;
use Packaged\Dal\Foundation\Dao;
use Packaged\Dal\Ql\AbstractQlConnection;
use Packaged\Dal\Ql\QlDataStore;
use Packaged\DalSchema\DalSchema;
use ReflectionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate extends ConsoleCommand
{
  /**
   * @throws ReflectionException
   * @throws DataStoreNotFoundException
   * @throws ConnectionNotFoundException
   * @throws Exception
   */
  public function executeCommand(InputInterface $input, OutputInterface $output): void
  {
    $schemas = DalSchema::findSchemas(dirname(__DIR__), 'MrEssex\\CubexSkeleton\\');
    $ctx = $this->getContext();
    $service = new LocalDatabaseService();
    $service->registerDatabaseConnections($ctx->getProjectRoot(), $ctx->getEnvironment());

    foreach($schemas as $schema)
    {
      $schema->getName();
      $name = 'cubex-base';
      $resolver = Dao::getDalResolver();
      $datastore = $resolver->getDataStore($name);
      if(!$datastore instanceof QlDataStore)
      {
        return;
      }

      /** @var AbstractQlConnection $connection */
      $connection = $datastore->getConnection();

      $output->writeln('Migrating Table: ' . $schema->getName());
      DalSchema::migrateTables($connection, $connection->getConfig()->getItem('database'), ...$schemas);
    }
  }
}
