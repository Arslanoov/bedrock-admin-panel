<?php

declare(strict_types=1);

namespace App\Service\Zip;

use App\Service\ChangeRightServiceInterface;
use RuntimeException;
use ZipArchive;

final class UnzipService implements UnzipServiceInterface
{
    private ZipArchive $zip;
    private ChangeRightServiceInterface $service;
    private string $worldsPath;
    private string $worldName;
    private string $url;

    /**
     * UnzipService constructor.
     * @param ZipArchive $zip
     * @param ChangeRightServiceInterface $service
     * @param string $worldsPath
     * @param string $worldName
     * @param string $url
     */
    public function __construct(
        ZipArchive $zip, ChangeRightServiceInterface $service,
        string $worldsPath, string $worldName, string $url
    )
    {
        $this->zip = $zip;
        $this->service = $service;
        $this->worldsPath = $worldsPath;
        $this->worldName = $worldName;
        $this->url = $url;
    }

    public function unzipIntoFolder(string $zipFilePath): void
    {
        $this->service->changeRight($this->url);

        if (!$this->zip->open($zipFilePath)) {
            throw new RuntimeException('Can not unzip file.');
        }

        if (!$this->zip->extractTo($this->worldsPath)) {
            throw new RuntimeException('Can not extract files.');
        }

        $this->zip->extractTo($this->worldsPath);
        $this->zip->close();

        $pathWithoutZipExt = explode('.zip', $zipFilePath)[0];
        $oldZipName = explode('/', $pathWithoutZipExt)[4];

        unlink($zipFilePath);
        if (file_exists($newPath = $this->worldsPath . '/' . $this->worldName)) {
            $this->removeDirectory($newPath);
        }
        rename($this->worldsPath . '/' . $oldZipName, $newPath);
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