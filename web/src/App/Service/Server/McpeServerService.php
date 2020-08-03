<?php

declare(strict_types=1);

namespace App\Service\Server;

final class McpeServerService implements ServerService
{
    private string $currentUrl;
    private string $key;

    /**
     * McpeServerService constructor.
     * @param string $currentUrl
     * @param string $key
     */
    public function __construct(string $currentUrl, string $key)
    {
        $this->currentUrl = $currentUrl;
        $this->key = $key;
    }

    public function start(): void
    {
        file_get_contents($this->currentUrl . '/start.php?key=' . $this->key);
    }

    public function stop(): void
    {
        file_get_contents($this->currentUrl . '/stop.php?key=' . $this->key);
    }

    public function restart(): void
    {
        file_get_contents($this->currentUrl . '/restart.php?key=' . $this->key);
    }
}