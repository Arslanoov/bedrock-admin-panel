<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ProfilerMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $start = hrtime(true) / 1000000;
        $response = $handler->handle($request);
        $stop = hrtime(true) / 1000000;

        return
            $response->withHeader('X-Load-Time', $stop - $start)
        ;
    }
}