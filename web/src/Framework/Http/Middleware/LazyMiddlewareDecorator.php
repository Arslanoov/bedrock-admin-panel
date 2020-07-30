<?php

declare(strict_types=1);

namespace Framework\Http\Middleware;

use Framework\Http\Pipeline\MiddlewareResolver;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LazyMiddlewareDecorator implements MiddlewareInterface
{
    private MiddlewareResolver $resolver;
    private ContainerInterface $container;
    private string $action;

    /**
     * LazyMiddlewareDecorator constructor.
     * @param MiddlewareResolver $resolver
     * @param ContainerInterface $container
     * @param string $action
     */
    public function __construct(MiddlewareResolver $resolver, ContainerInterface $container, string $action)
    {
        $this->resolver = $resolver;
        $this->container = $container;
        $this->action = $action;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $middleware = $this->resolver->resolve($this->container->get($this->action));
        return $middleware->process($request, $handler);
    }
}