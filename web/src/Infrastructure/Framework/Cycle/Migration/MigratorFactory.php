<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Cycle\Migration;

use Psr\Container\ContainerInterface;
use Spiral\Migrations;
use Spiral\Database;

final class MigratorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Migrations\Migrator(
            $container->get(Migrations\Config\MigrationConfig::class),
            $container->get(Database\DatabaseManager::class),
            new Migrations\FileRepository($container->get(Migrations\Config\MigrationConfig::class))
        );
    }
}