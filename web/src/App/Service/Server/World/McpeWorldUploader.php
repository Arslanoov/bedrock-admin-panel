<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use App\Service\ChangeRightServiceInterface;
use Psr\Http\Message\UploadedFileInterface;

final class McpeWorldUploader implements WorldUploader
{
    private ChangeRightServiceInterface $service;
    private string $worldsPath;
    private string $url;

    /**
     * McpeWorldUploader constructor.
     * @param ChangeRightServiceInterface $service
     * @param string $worldsPath
     * @param string $url
     */
    public function __construct(ChangeRightServiceInterface $service, string $worldsPath, string $url)
    {
        $this->service = $service;
        $this->worldsPath = $worldsPath;
        $this->url = $url;
    }

    public function upload(UploadedFileInterface $world): string
    {
        $this->service->changeRight($this->url);
        $path = $this->worldsPath . '/' . $world->getClientFilename();
        $world->moveTo($path);
        return $path;
    }
}