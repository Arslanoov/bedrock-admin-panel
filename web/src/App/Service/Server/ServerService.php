<?php

declare(strict_types=1);

namespace App\Service\Server;

interface ServerService
{
    public function start(): void;
    public function stop(): void;
    public function restart(): void;
}