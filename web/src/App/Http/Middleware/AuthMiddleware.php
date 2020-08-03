<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Framework\Http\Exception\AccessDeniedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws AccessDeniedException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Temporary solution
        $cookieKey = $request->getCookieParams()['key'] ?? '';
        $key = file_get_contents('./.key');

        if ($key !== $cookieKey) {
            $requestKey = $request->getQueryParams()['key'] ?? '';
            if ($key !== $requestKey) {
                throw new AccessDeniedException();
            }

            setcookie("key", $key, 2147483647, '/');

            return $handler->handle($request);
        }

        return $handler->handle($request);
    }
}