<?php

declare(strict_types=1);

namespace App\Service;

interface ChangeRightServiceInterface
{
    public function changeRight(string $url): void;
}