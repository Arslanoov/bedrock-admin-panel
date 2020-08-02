<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist;

use Domain\Whitelist\UseCase\RemovePlayer\Command;
use Domain\Whitelist\UseCase\RemovePlayer\Handler;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RemoveAction implements RequestHandlerInterface
{
    private Handler $handler;
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private Router $router;

    /**
     * RemoveAction constructor.
     * @param Handler $handler
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param Router $router
     */
    public function __construct(Handler $handler, ResponseFactory $response, TemplateRenderer $template, Router $router)
    {
        $this->handler = $handler;
        $this->response = $response;
        $this->template = $template;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $uuid = $request->getAttribute('uuid') ?? '';
        $name = $request->getAttribute('name') ?? '';

        $this->handler->handle(new Command(
            $uuid, $name
        ));

        return $this->response->redirect(
            $this->router->generate('admin.whitelist.index', [])
        );
    }
}