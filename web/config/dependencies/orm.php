<?php

use Furious\Container\Container;
use Infrastructure\Framework\Cycle\DatabaseManagerFactory;
use Infrastructure\Framework\Cycle\Migration\MigrationConfigFactory;
use Infrastructure\Framework\Cycle\Migration\MigratorFactory;
use Infrastructure\Framework\Cycle\ORMFactory;
use Spiral\Database;
use Cycle\ORM;
use Spiral\Migrations\Migrator;
use Spiral\Migrations;
use Spiral\Tokenizer;

/** @var Container $container */

$container->set(Database\DatabaseManager::class, (new DatabaseManagerFactory())($container));

$container->set(ORM\ORMInterface::class, (new ORMFactory())($container));

$container->set(ORM\ORM::class, (new ORMFactory())($container));

$container->set(Migrations\Config\MigrationConfig::class, (new MigrationConfigFactory)($container));

$container->set(Migrator::class, (new MigratorFactory())($container));

$container->set(Tokenizer\ClassesInterface::class, function () {
    return (new Tokenizer\Tokenizer(new Tokenizer\Config\TokenizerConfig([
        'directories' => ['src/Domain/']
    ])))->classLocator();
});

$container->set(ORM\Transaction::class, function (Container $container) {
    return new Cycle\ORM\Transaction($container->get(ORM\ORM::class));
});