<?php

declare(strict_types=1);

namespace App\Service\Zip;

interface ZipServiceInterface
{
    public function zip(string $file): string;
}