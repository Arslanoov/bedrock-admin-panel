<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Cycle;

use Psr\Container\ContainerInterface;
use Spiral\Database;

final class DatabaseManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Database\DatabaseManager(
            new Database\Config\DatabaseConfig([
                'default'     => 'default',
                'databases'   => [
                    'default' => ['connection' => $container->get('config')['db']['default_connection']]
                ],
                'connections' => $container->get('config')['db']['connections']
            ])
        );
    }
}