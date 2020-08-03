<?php

declare(strict_types=1);

namespace App\Service;

final class WorldsChangeRightService implements ChangeRightServiceInterface
{
    private string $key;

    /**
     * WorldsChangeRightService constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function changeRight(string $url): void
    {
        file_get_contents($url . '/changeright.php?key=' . $this->key);
    }
}