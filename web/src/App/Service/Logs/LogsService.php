<?php

declare(strict_types=1);

namespace App\Service\Logs;

interface LogsService
{
    public function get(int $limit = 100): array;
}