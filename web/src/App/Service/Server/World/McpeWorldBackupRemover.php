<?php

declare(strict_types=1);

namespace App\Service\Server\World;

final class McpeWorldBackupRemover implements WorldBackupRemover
{
    private string $backupsPath;

    /**
     * McpeWorldBackupRemover constructor.
     * @param string $backupsPath
     */
    public function __construct(string $backupsPath)
    {
        $this->backupsPath = $backupsPath;
    }

    public function remove(string $name): void
    {
        $path = $this->backupsPath . '/' . $name;

        if (is_dir($path) and file_exists($path)) {
            $this->removeDirectory($path);
        }

        if (file_exists($path . '.zip')) {
            unlink($path . '.zip');
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