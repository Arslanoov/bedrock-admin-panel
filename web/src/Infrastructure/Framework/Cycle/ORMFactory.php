<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Cycle;

use Psr\Container\ContainerInterface;
use Cycle\ORM;
use Spiral\Database;

final class ORMFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $orm = new ORM\ORM(new ORM\Factory($container->get(Database\DatabaseManager::class)));

        $schemas = $container->get('config')['schemas'];
        $orm = $orm->withSchema(new ORM\Schema($schemas));

        return $orm;
    }
}