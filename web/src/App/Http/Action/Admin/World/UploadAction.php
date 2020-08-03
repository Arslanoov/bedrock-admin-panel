<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\World;

use App\Service\Server\World\WorldUploader;
use App\Service\Zip\UnzipServiceInterface;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;
use InvalidArgumentException;

final class UploadAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private UnzipServiceInterface $unzipService;
    private WorldUploader $uploader;
    private Router $router;

    /**
     * UploadAction constructor.
     * @param ResponseFactory $response
     * @param UnzipServiceInterface $unzipService
     * @param WorldUploader $uploader
     * @param Router $router
     */
    public function __construct(ResponseFactory $response, UnzipServiceInterface $unzipService, WorldUploader $uploader, Router $router)
    {
        $this->response = $response;
        $this->unzipService = $unzipService;
        $this->uploader = $uploader;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var UploadedFileInterface $zip */
        $zip = $request->getUploadedFiles()['file'];
        if (!in_array($zip->getClientMediaType(), [
            'application/zip',
            'application/x-zip-compressed'
        ])) {
            throw new InvalidArgumentException('Uploaded file must be in zip format');
        }

        $path = $this->uploader->upload($zip);
        $this->unzipService->unzipIntoFolder($path);

        return $this->response->redirect(
            $this->router->generate('admin.world.index', [])
        );
    }
}