<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\World;

use App\Service\Server\World\WorldRemover;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RegenerateAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private Router $router;
    private WorldRemover $worldRemover;

    /**
     * RegenerateAction constructor.
     * @param ResponseFactory $response
     * @param Router $router
     * @param WorldRemover $worldRemover
     */
    public function __construct(ResponseFactory $response, Router $router, WorldRemover $worldRemover)
    {
        $this->response = $response;
        $this->router = $router;
        $this->worldRemover = $worldRemover;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->worldRemover->remove();

        return $this->response->redirect(
            $this->router->generate('admin.world.index', [])
        );
    }
}