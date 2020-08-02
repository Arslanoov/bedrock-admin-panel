<?php

declare(strict_types=1);

namespace App\Service\Logs;

final class FileLogsService implements LogsService
{
    private string $logsUrl;

    /**
     * FileLogsService constructor.
     * @param string $logsUrl
     */
    public function __construct(string $logsUrl)
    {
        $this->logsUrl = $logsUrl;
    }

    public function get(int $limit = 100): array
    {
        $logs = explode("\n", file_get_contents($this->logsUrl));
        $latestLogs = array_reverse($logs);
        return array_slice($latestLogs, 0, $limit);
    }
}