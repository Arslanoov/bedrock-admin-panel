<?php

declare(strict_types=1);

namespace App\Service\Zip;

interface UnzipServiceInterface
{
    public function unzipIntoFolder(string $zipFilePath): void;
}