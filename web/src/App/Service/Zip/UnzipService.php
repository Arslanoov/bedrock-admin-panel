<?php

declare(strict_types=1);

namespace App\Service\Zip;

use RuntimeException;
use ZipArchive;

final class UnzipService implements UnzipServiceInterface
{
    private const WORLD_PATH = '/app/data/worlds/level';

    public function unzipIntoFolder(string $zipFilePath): void
    {
        $zip = new ZipArchive();

        if (!$zip->open($zipFilePath)) {
            throw new RuntimeException('Can not unzip file.');
        }

        if (!$zip->extractTo(self::WORLD_PATH)) {
            throw new RuntimeException('Can not extract files.');
        }

        $zip->extractTo(self::WORLD_PATH);
        $zip->close();

        chmod(self::WORLD_PATH, 0777);
    }
}