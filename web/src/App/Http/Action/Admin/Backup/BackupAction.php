<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Backup;

use App\Service\Server\World\WorldBackupMaker;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class BackupAction implements RequestHandlerInterface
{
    private WorldBackupMaker $backup;
    private ResponseFactory $response;
    private Router $router;

    /**
     * BackupAction constructor.
     * @param WorldBackupMaker $backup
     * @param ResponseFactory $response
     * @param Router $router
     */
    public function __construct(WorldBackupMaker $backup, ResponseFactory $response, Router $router)
    {
        $this->backup = $backup;
        $this->response = $response;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->backup->make();

        return $this->response->redirect(
            $this->router->generate('admin.backup.index', [])
        );
    }
}