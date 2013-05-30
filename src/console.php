<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper;

$console = new Application('Walker', '0.2');


// This make possibile to re-use default Doctrine console command
$dm = new DocumentManagerHelper( $app['doctrine.odm.mongodb.dm'] );
$console->getHelperSet()->set($dm, 'dm');

// Add Doctrine ODM commands
$console->addCommands(array(
    new Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateDocumentsCommand(),
    new Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand(),
    new Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand(),
    new Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateRepositoriesCommand(),
    new Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand(),
    new Doctrine\ODM\MongoDB\Tools\Console\Command\ClearCache\MetadataCommand(),
));


$console->addCommands(array(
    // DBAL Commands
    new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),

    // ORM Commands
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
    new \Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
    new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand(),
    new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
    new \Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
));

return $console;
