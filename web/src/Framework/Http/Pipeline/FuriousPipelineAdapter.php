<?php

declare(strict_types=1);

namespace Framework\Http\Pipeline;

use Furious\Psr15\MiddlewarePipe;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class FuriousPipelineAdapter implements MiddlewarePipeInterface
{
    private MiddlewarePipe $pipeline;

    public function __construct()
    {
        $this->pipeline = new MiddlewarePipe();
    }

    public function pipe(MiddlewareInterface $middleware): void
    {
        $this->pipeline->pipe($middleware);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->pipeline->handle($request);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->pipeline->process($request, $handler);
    }
}