<?php

declare(strict_types=1);

namespace Framework\Http\Router;

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\UnableToFoundRouteException;
use Psr\Http\Message\ServerRequestInterface;

interface  Router
{
    /**
     * @param ServerRequestInterface $request
     * @throws RequestNotMatchedException
     * @return Result
     */
    public function match(ServerRequestInterface $request): Result;

    /**
     * @param string $name
     * @param array $params
     * @throws UnableToFoundRouteException
     * @return string
     */
    public function generate(string $name, array $params): string;

    /**
     * @param Route $data
     */
    public function addRoute(Route $data): void;
}