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
    private string $secondWorldName;

    /**
     * McpeWorldRemover constructor.
     * @param ChangeRightServiceInterface $service
     * @param string $url
     * @param string $worldsPath
     * @param string $worldsName
     * @param string $secondWorldName
     */
    public function __construct(ChangeRightServiceInterface $service, string $url, string $worldsPath, string $worldsName, string $secondWorldName)
    {
        $this->service = $service;
        $this->url = $url;
        $this->worldsPath = $worldsPath;
        $this->worldsName = $worldsName;
        $this->secondWorldName = $secondWorldName;
    }

    public function remove(): void
    {
        $path = $this->worldsPath . '/' . $this->worldsName;
        $secondPath = $this->worldsPath . '/' . $this->secondWorldName;

        if (is_dir($path) and file_exists($path)) {
            $this->service->changeRight($this->url);
            $this->removeDirectory($path);
        }

        if (is_dir($secondPath) and file_exists($secondPath)) {
            $this->service->changeRight($this->url);
            $this->removeDirectory($secondPath);
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