<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\World;

use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * HomeAction constructor.
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
            $this->template->render('admin/world/index')
        );
    }
}