<?php

declare(strict_types=1);

namespace App\Service\Server\World;

interface WorldBackupRemover
{
    public function remove(string $name): void;
}