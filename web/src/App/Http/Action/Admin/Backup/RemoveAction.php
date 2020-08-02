<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Backup;

use App\Service\Server\World\WorldBackupRemover;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RemoveAction implements RequestHandlerInterface
{
    private WorldBackupRemover $backup;
    private ResponseFactory $response;
    private Router $router;

    /**
     * BackupAction constructor.
     * @param WorldBackupRemover $backup
     * @param ResponseFactory $response
     * @param Router $router
     */
    public function __construct(WorldBackupRemover $backup, ResponseFactory $response, Router $router)
    {
        $this->backup = $backup;
        $this->response = $response;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getParsedBody()['name'] ?? '';
        $this->backup->remove($name);

        return $this->response->redirect(
            $this->router->generate('admin.backup.index', [])
        );
    }
}