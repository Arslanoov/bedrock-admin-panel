<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\AddPlayer;

final class Command
{
    public string $name;

    /**
     * Command constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}