<?php

declare(strict_types=1);

namespace App\Service\Zip;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

final class ZipService implements ZipServiceInterface
{
    private ZipArchive $zip;
    private string $backupsPath;

    /**
     * ZipService constructor.
     * @param ZipArchive $zip
     * @param string $backupsPath
     */
    public function __construct(ZipArchive $zip, string $backupsPath)
    {
        $this->zip = $zip;
        $this->backupsPath = $backupsPath;
    }

    public function zip(string $file): string
    {
        $path = $this->backupsPath . '/' . $file;

        /*if (!$this->zip->open($path . '.zip')) {
            throw new RuntimeException("Can't zip backup");
        }*/

        $this->zip->open($path . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $this->zip->addFile($filePath, $relativePath);
            }
        }

        $this->zip->close();

        return $path . '.zip';
    }
}