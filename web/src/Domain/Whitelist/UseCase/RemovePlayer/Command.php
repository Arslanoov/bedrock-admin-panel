<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\RemovePlayer;

final class Command
{
    public string $uuid;
    public string $name;

    /**
     * Command constructor.
     * @param string $uuid
     * @param string $name
     */
    public function __construct(string $uuid, string $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }
}