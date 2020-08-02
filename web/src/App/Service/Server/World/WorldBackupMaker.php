<?php

declare(strict_types=1);

namespace App\Service\Server\World;

interface WorldBackupMaker
{
    public function make(): void;
}