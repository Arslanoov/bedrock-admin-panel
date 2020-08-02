<?php

declare(strict_types=1);

namespace App\Service;

interface FileServiceInterface
{
    public function getBackupFiles(): array;
}