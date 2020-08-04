<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use Framework\Http\Exception\InvalidArgumentException;

final class McpeWorldTimestampBackupMaker implements WorldBackupMaker
{
    private string $worldsPath;
    private string $worldName;
    private string $secondWorldName;
    private string $backupsPath;

    /**
     * McpeWorldTimestampBackupMaker constructor.
     * @param string $worldsPath
     * @param string $worldName
     * @param string $secondWorldName
     * @param string $backupsPath
     */
    public function __construct(string $worldsPath, string $worldName, string $secondWorldName, string $backupsPath)
    {
        $this->worldsPath = $worldsPath;
        $this->worldName = $worldName;
        $this->secondWorldName = $secondWorldName;
        $this->backupsPath = $backupsPath;
    }

    public function make(): void
    {
        $worldPath = $this->worldsPath . '/' . $this->worldName;
        $secondPath = $this->worldsPath . '/' . $this->secondWorldName;

        if (!file_exists($worldPath) or !is_dir($worldPath)) {
            if (file_exists($secondPath) and is_dir($secondPath)) {
                if (!file_exists($path = $this->backupsPath . '/' . date('d-m-Y') . '.' . date('H-i-s'))) {
                    mkdir($path, 0777, true);
                }

                $this->recurseCopy(
                    $secondPath,
                    $path
                );

                return;
            }

            throw new InvalidArgumentException('World does not exist.');
        }
        if (!file_exists($path = $this->backupsPath . '/' . date('d-m-Y') . '.' . date('H-i-s'))) {
            mkdir($path, 0777, true);
        }

        $this->recurseCopy(
            $worldPath,
            $path
        );
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