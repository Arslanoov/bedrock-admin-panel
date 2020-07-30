<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class ErrorHandler implements MiddlewareInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private bool $debug;

    /**
     * ErrorHandler constructor.
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param bool $debug
     */
    public function __construct(ResponseFactory $response, TemplateRenderer $template, bool $debug)
    {
        $this->response = $response;
        $this->template = $template;
        $this->debug = $debug;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            return $this->response->html($this->template->render('errors/500', [
                'message' => $this->debug ? $e->getMessage() : '500'
            ]), 500);
        }
    }
}