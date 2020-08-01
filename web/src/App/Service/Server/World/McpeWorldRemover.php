<?php

declare(strict_types=1);

namespace App\Service\Server\World;

final class McpeWorldRemover implements WorldRemover
{
    private const WORLD_PATH = '/app/data/worlds/level';

    private string $currentUrl;

    /**
     * McpeServerService constructor.
     */
    public function __construct()
    {
        // Temporary solution
        $this->currentUrl = 'http://'.  explode(':', $_SERVER['HTTP_HOST'])[0] . ':57152';
    }

    public function remove(): void
    {
        if (is_dir(self::WORLD_PATH) and file_exists(self::WORLD_PATH)) {
            file_get_contents($this->currentUrl . '/changeright.php');
            $this->removeDirectory(self::WORLD_PATH);
        }
    }

    private function removeDirectory(string $dir): void
    {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }
        rmdir($dir);
    }
}