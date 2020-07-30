<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Cycle\Migration;

use Psr\Container\ContainerInterface;
use Spiral\Migrations;

final class MigrationConfigFactory
{
    public function __invoke(ContainerInterface $container): Migrations\Config\MigrationConfig
    {
        return new Migrations\Config\MigrationConfig([
            'directory' => $container->get('config')['orm']['migrations']['directory'],
            'table' => $container->get('config')['orm']['migrations']['table']
        ]);
    }
}