<?php

declare(strict_types=1);

namespace App\Service\Server;

final class McpeServerService implements ServerService
{
    private string $currentUrl;

    /**
     * McpeServerService constructor.
     */
    public function __construct()
    {
        // Temporary solution
        $this->currentUrl = 'http://'.  $_SERVER['HTTP_HOST'] . ':57152';
    }

    public function start(): void
    {
        file_get_contents($this->currentUrl . '/start.php');
    }

    public function stop(): void
    {
        file_get_contents($this->currentUrl . '/stop.php');
    }

    public function restart(): void
    {
        file_get_contents($this->currentUrl . '/restart.php');
    }
}