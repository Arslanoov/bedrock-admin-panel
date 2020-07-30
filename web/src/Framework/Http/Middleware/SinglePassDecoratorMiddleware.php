<?php

declare(strict_types=1);

namespace Framework\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class SinglePassDecoratorMiddleware implements MiddlewareInterface
{
    private RequestHandlerInterface $handler;

    public function __construct(RequestHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->handler->handle($request);
    }
}