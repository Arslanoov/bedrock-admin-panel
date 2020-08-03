<?php

declare(strict_types=1);

namespace App\Service;

use Framework\Http\Exception\InvalidArgumentException;

final class FileService implements FileServiceInterface
{
    private string $backupsPath;

    /**
     * FileService constructor.
     * @param string $backupsPath
     */
    public function __construct(string $backupsPath)
    {
        $this->backupsPath = $backupsPath;
    }

    public function getBackupFiles(): array
    {
        if (!$files = scandir($this->backupsPath)) {
            throw new InvalidArgumentException('Incorrect directory');
        }

        $backupFiles = [];
        foreach ($files as $file) {
            if (substr($file, -4, 4) !== '.zip') {
                $size = $this->getDirectorySize($this->backupsPath . '/' . $file);
                $backupFiles[] = [
                    'name' => $file,
                    'size' => $size
                ];
            }
        }

        return array_reverse(array_slice($backupFiles, 2));
    }

    private function getDirectorySize(string $path): int
    {
        $io = popen( '/usr/bin/du -sk ' . $path, 'r');
        $size = fgets($io, 4096);
        $folderSize = substr($size, 0, strpos($size, "\t") );
        pclose($io);

        return (int) $folderSize;
    }
}