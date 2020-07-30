<?php

declare(strict_types=1);

namespace Framework\Http\Pipeline;

use Framework\Http\Middleware\LazyMiddlewareDecorator;
use Framework\Http\Middleware\SinglePassDecoratorMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionObject;

class MiddlewareResolver
{
    private ContainerInterface $container;

    /**
     * MiddlewareResolver constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resolve($handler)
    {
        if (is_array($handler)) {
            return $this->createPipe($handler);
        }

        if (is_string($handler) and $this->container->has($handler)) {
            return new LazyMiddlewareDecorator($this, $this->container, $handler);
        }

        if ($handler instanceof MiddlewareInterface) {
            return $handler;
        }

        if (is_object($handler)) {
            /** @var RequestHandlerInterface $handler */
            $reflection = new ReflectionObject($handler);
            if ($reflection->hasMethod('handle')) {
                return new SinglePassDecoratorMiddleware($handler);
            }
        }

        throw new UnknownMiddlewareTypeException($handler);
    }

    private function createPipe(array $handlers): MiddlewarePipeInterface
    {
        $pipeline = $this->container->get(MiddlewarePipeInterface::class);
        foreach ($handlers as $handler) {
            $pipeline->pipe($this->resolve($handler));
        }
        return $pipeline;
    }
}