<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewarePipeInterface;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Pipeline\PathMiddlewareDecorator;
use Framework\Http\Router\Route;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class Application
{
    private Router $router;
    private RequestHandlerInterface $default;
    private MiddlewareResolver $resolver;
    private MiddlewarePipeInterface $pipeline;

    public function __construct(
        MiddlewareResolver $resolver, Router $router,
        RequestHandlerInterface $default, MiddlewarePipeInterface $pipeline
    )
    {
        $this->resolver = $resolver;
        $this->router = $router;
        $this->default = $default;
        $this->pipeline = $pipeline;
    }

    public function pipe($path, $middleware = null): void
    {
        if ($middleware === null) {
            $this->pipeline->pipe($this->resolver->resolve($path));
        } else {
            $this->pipeline->pipe(new PathMiddlewareDecorator($path, $this->resolver->resolve($middleware)));
        }
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->pipeline->process($request, $this->default);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->pipeline->process($request, $handler);
    }

    private function add($name, $path, $handler, array $methods, array $options = []): void
    {
        $this->router->addRoute(new Route($name, $path, $handler, $methods, $options));
    }

    public function any($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, $options);
    }

    public function get($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, ['GET'], $options);
    }

    public function post($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, ['POST'], $options);
    }

    public function put($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, ['PUT'], $options);
    }

    public function patch($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, ['PATCH'], $options);
    }

    public function delete($name, $path, $handler, array $options = []): void
    {
        $this->add($name, $path, $handler, ['DELETE'], $options);
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }
}