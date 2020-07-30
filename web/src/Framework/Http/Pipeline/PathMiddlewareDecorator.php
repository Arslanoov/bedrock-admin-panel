<?php

declare(strict_types=1);

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class PathMiddlewareDecorator implements MiddlewareInterface
{
    private MiddlewareInterface $middleware;
    private string $prefix;

    public function __construct(string $prefix, MiddlewareInterface $middleware)
    {
        $this->prefix = $this->normalizePrefix($prefix);
        $this->middleware = $middleware;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $path = $request->getUri()->getPath() ?: '/';

        if (strlen($path) < strlen($this->prefix)) {
            return $handler->handle($request);
        }

        if (0 !== stripos($path, $this->prefix)) {
            return $handler->handle($request);
        }

        $border = $this->getBorder($path);
        if ($border && '/' !== $border) {
            return $handler->handle($request);
        }

        $requestToProcess = $this->prefix !== '/'
            ? $this->prepareRequestWithTruncatedPrefix($request)
            : $request;

        return $this->middleware->process(
            $requestToProcess,
            $this->prepareHandlerForOriginalRequest($handler)
        );
    }

    private function getBorder(string $path) : string
    {
        if ($this->prefix === '/') {
            return '/';
        }

        $length = strlen($this->prefix);
        return strlen($path) > $length ? $path[$length] : '';
    }

    private function prepareRequestWithTruncatedPrefix(ServerRequestInterface $request) : ServerRequestInterface
    {
        $uri  = $request->getUri();
        $path = $this->getTruncatedPath($this->prefix, $uri->getPath());
        $new  = $uri->withPath($path);
        return $request->withUri($new);
    }

    private function getTruncatedPath(string $segment, string $path) : string
    {
        if ($segment === $path) {
            return '';
        }

        return substr($path, strlen($segment));
    }

    private function prepareHandlerForOriginalRequest(RequestHandlerInterface $handler) : RequestHandlerInterface
    {
        return new class ($handler, $this->prefix) implements RequestHandlerInterface {
            private RequestHandlerInterface $handler;
            private string $prefix;

            public function __construct(RequestHandlerInterface $handler, string $prefix)
            {
                $this->handler = $handler;
                $this->prefix = $prefix;
            }

            public function handle(ServerRequestInterface $request) : ResponseInterface
            {
                $uri = $request->getUri();
                $uri = $uri->withPath($this->prefix . $uri->getPath());
                return $this->handler->handle($request->withUri($uri));
            }
        };
    }

    private function normalizePrefix(string $prefix) : string
    {
        $prefix = strlen($prefix) > 1 ? rtrim($prefix, '/') : $prefix;
        if (0 !== strpos($prefix, '/')) {
            $prefix = '/' . $prefix;
        }
        return $prefix;
    }
}