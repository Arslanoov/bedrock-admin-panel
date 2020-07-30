<?php

declare(strict_types=1);

namespace Framework\Http\Middleware;

use Framework\Http\Router\Result;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

final class RouteMiddleware implements MiddlewareInterface
{
    private Router $router;

    /**
     * RouteMiddleware constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $result = $this->router->match($request);
            foreach ($result->getParams() as $attribute => $value) {
                $request = $request->withAttribute($attribute, $value);
            }
            return $handler->handle($request->withAttribute(Result::class, $result));
        } catch (Throwable $e) {
            return $handler->handle($request);
        }
    }
}