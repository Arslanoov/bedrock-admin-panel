<?php

declare(strict_types=1);

namespace App\Http\Middleware\ErrorHandler;

use Framework\Http\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class InvalidArgumentMiddleware implements MiddlewareInterface
{
    private ResponseGenerator $response;

    /**
     * InvalidArgumentMiddleware constructor.
     * @param ResponseGenerator $response
     */
    public function __construct(ResponseGenerator $response)
    {
        $this->response = $response;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Framework\Http\Exception\InvalidArgumentException $e) {
            return $this->response->generate($e, $request);
        }
    }
}