<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist\Add;

use Domain\Whitelist\UseCase\AddPlayer\Command;
use Domain\Whitelist\UseCase\AddPlayer\Handler;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    private Handler $handler;
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private Router $router;

    /**
     * AddAction constructor.
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
        if (!$name = $request->getParsedBody()['name']) {
            throw new InvalidArgumentException('Empty player name.');
        }

        $this->handler->handle(new Command(
            $name
        ));

        return $this->response->redirect(
            $this->router->generate('admin.whitelist.index', [])
        );
    }
}