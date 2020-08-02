<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use App\Service\ChangeRightServiceInterface;

final class McpeWorldRemover implements WorldRemover
{
    private ChangeRightServiceInterface $service;
    private string $url;
    private string $worldsPath;
    private string $worldsName;

    /**
     * McpeWorldRemover constructor.
     * @param ChangeRightServiceInterface $service
     * @param string $url
     * @param string $worldsPath
     * @param string $worldsName
     */
    public function __construct(ChangeRightServiceInterface $service, string $url, string $worldsPath, string $worldsName)
    {
        $this->service = $service;
        $this->url = $url;
        $this->worldsPath = $worldsPath;
        $this->worldsName = $worldsName;
    }

    public function remove(): void
    {
        $path = $this->worldsPath . '/' . $this->worldsName;

        if (is_dir($path) and file_exists($path)) {
            $this->service->changeRight($this->url);
            $this->removeDirectory($path);
        }
    }

    private function removeDirectory(string $dir): void
    {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        rmdir($dir);
    }
}