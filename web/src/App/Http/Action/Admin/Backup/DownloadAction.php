<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Backup;

use App\Service\Zip\ZipServiceInterface;
use Framework\Http\Psr7\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DownloadAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private ZipServiceInterface $zipper;

    /**
     * DownloadAction constructor.
     * @param ResponseFactory $response
     * @param ZipServiceInterface $zipper
     */
    public function __construct(ResponseFactory $response, ZipServiceInterface $zipper)
    {
        $this->response = $response;
        $this->zipper = $zipper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->getParsedBody()['name'] ?? '';

        $file = $this->zipper->zip($name);

        // Temporary solution
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"". basename($file) ."\"");

        readfile ($file);
        die;
    }
}