<?php

declare(strict_types=1);

namespace Framework\Http;

use Psr\Container\ContainerInterface;

final class ActionResolver
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resolve($handler): callable
    {
        return $this->container->get($handler);
    }
}