<?php

declare(strict_types=1);

namespace App\Service\Zip;

use RuntimeException;
use ZipArchive;

final class UnzipService implements UnzipServiceInterface
{
    private const WORLDS_PATH = '/app/data/worlds/';

    public function unzipIntoFolder(string $zipFilePath): void
    {
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath)) {
            $zip->extractTo(self::WORLDS_PATH);
            $zip->close();
            return;
        }

        throw new RuntimeException('Can not unzip file.');
    }
}