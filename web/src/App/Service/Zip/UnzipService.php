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
    private string $secondWorldName;
    private string $url;

    /**
     * UnzipService constructor.
     * @param ZipArchive $zip
     * @param ChangeRightServiceInterface $service
     * @param string $worldsPath
     * @param string $worldName
     * @param string $secondWorldName
     * @param string $url
     */
    public function __construct(ZipArchive $zip, ChangeRightServiceInterface $service, string $worldsPath, string $worldName, string $secondWorldName, string $url)
    {
        $this->zip = $zip;
        $this->service = $service;
        $this->worldsPath = $worldsPath;
        $this->worldName = $worldName;
        $this->secondWorldName = $secondWorldName;
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
        if (file_exists($secondNewPath = $this->worldsPath . '/' . $this->secondWorldName)) {
            $this->removeDirectory($secondNewPath);
        }
        rename($worldPath = $this->worldsPath . '/' . $oldZipName, $newPath);
        $this->recurseCopy($newPath, $this->worldsPath . '/' . $this->secondWorldName);
    }

    private function removeDirectory(string $dir): void
    {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        rmdir($dir);
    }

    private function recurseCopy(string $src, string $dst): void
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}