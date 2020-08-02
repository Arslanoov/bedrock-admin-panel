<?php

declare(strict_types=1);

namespace App\Service\Zip;

use RuntimeException;

interface UnzipServiceInterface
{
    /**
     * @param string $zipFilePath
     * @throws RuntimeException
     */
    public function unzipIntoFolder(string $zipFilePath): void;
}