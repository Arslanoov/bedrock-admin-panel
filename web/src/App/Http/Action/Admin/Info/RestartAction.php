<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Info;

use App\Service\Server\ServerService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RestartAction implements RequestHandlerInterface
{
    private ServerService $server;
    private ResponseFactory $response;
    private Router $router;

    /**
     * RestartAction constructor.
     * @param ServerService $server
     * @param ResponseFactory $response
     * @param Router $router
     */
    public function __construct(ServerService $server, ResponseFactory $response, Router $router)
    {
        $this->server = $server;
        $this->response = $response;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->server->restart();

        return $this->response->redirect(
            $this->router->generate('admin.info.index', [])
        );
    }
}