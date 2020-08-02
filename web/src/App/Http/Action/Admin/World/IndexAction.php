<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\World;

use App\Service\FileServiceInterface;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private FileServiceInterface $fileService;
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * IndexAction constructor.
     * @param FileServiceInterface $fileService
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(FileServiceInterface $fileService, ResponseFactory $response, TemplateRenderer $template)
    {
        $this->fileService = $fileService;
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $backups = $this->fileService->getBackupFiles();

        return $this->response->html(
            $this->template->render('admin/world/index', [
                'backups' => $backups
            ])
        );
    }
}