<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist\Edit;

use Domain\Whitelist\Entity\Role;
use Domain\Whitelist\Entity\WhitelistRepository;
use Domain\Whitelist\UseCase\EditPlayer as EditPlayerInWhitelist;
use Domain\Permission\UseCase\ResetByWhitelist;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private EditPlayerInWhitelist\Handler $whitelistHandler;
    private ResetByWhitelist\Handler $permissionHandler;
    private Router $router;
    private WhitelistRepository $whitelist;

    /**
     * RequestAction constructor.
     * @param ResponseFactory $response
     * @param EditPlayerInWhitelist\Handler $whitelistHandler
     * @param ResetByWhitelist\Handler $permissionHandler
     * @param Router $router
     * @param WhitelistRepository $whitelist
     */
    public function __construct(ResponseFactory $response, EditPlayerInWhitelist\Handler $whitelistHandler, ResetByWhitelist\Handler $permissionHandler, Router $router, WhitelistRepository $whitelist)
    {
        $this->response = $response;
        $this->whitelistHandler = $whitelistHandler;
        $this->permissionHandler = $permissionHandler;
        $this->router = $router;
        $this->whitelist = $whitelist;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $uuid = $request->getAttribute('uuid') ?? '';
        $role = $request->getParsedBody()['role'] ?? '';
        $ignoresPlayerLimit = $request->getParsedBody()['ignores_player_limit'] === 'true' ? true : false;

        $this->whitelistHandler->handle(new EditPlayerInWhitelist\Command(
            $uuid, $role, $ignoresPlayerLimit
        ));

        $whitelist = $this->whitelist->get();
        $this->permissionHandler->handle(new ResetByWhitelist\Command($whitelist, $uuid, new Role($role)));

        return $this->response->redirect(
            $this->router->generate('admin.whitelist.index', [])
        );
    }
}