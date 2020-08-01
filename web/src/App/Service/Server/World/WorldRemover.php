<?php

declare(strict_types=1);

namespace App\Service\Server\World;

interface WorldRemover
{
    public function remove(): void;
}