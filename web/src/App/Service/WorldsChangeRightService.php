<?php

declare(strict_types=1);

namespace App\Service;

final class WorldsChangeRightService implements ChangeRightServiceInterface
{
    public function changeRight(string $url): void
    {
        file_get_contents($url . '/changeright.php');
    }
}