<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NotFoundHandler implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * NotFoundHandler constructor.
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(ResponseFactory $response, TemplateRenderer $template)
    {
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response->html(
            $this->template->render('errors/404'), 404
        );
    }
}