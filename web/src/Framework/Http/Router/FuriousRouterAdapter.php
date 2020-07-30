<?php

declare(strict_types=1);

namespace Framework\Http\Router;

use Furious\Router\Collection\RouteCollection;
use Psr\Http\Message\ServerRequestInterface;
use Furious\Router\Router as FuriousRouter;
use Furious\Router\Route\Route as FuriousRoute;

final class FuriousRouterAdapter implements Router
{
    private FuriousRouter $router;

    public function __construct()
    {
        $this->router = new FuriousRouter(new RouteCollection());
    }

    public function match(ServerRequestInterface $request): Result
    {
        $match = $this->router->match($request);
        return new Result(
            $match->getRouteName(),
            $match->getAction(),
            $match->getParams()
        );
    }

    public function generate(string $name, array $params): string
    {
        return $this->router->generate($name, $params);
    }

    public function addRoute(Route $route): void
    {
        $this->router->addRoute(new FuriousRoute(
            $route->name,
            $route->path,
            $route->action,
            $route->methods,
            $route->options
        ));
    }
}