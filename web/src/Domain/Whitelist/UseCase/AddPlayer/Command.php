<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\AddPlayer;

final class Command
{
    public string $name;
    public bool $ignoresPlayerLimit;

    /**
     * Command constructor.
     * @param string $name
     * @param bool $ignoresPlayerLimit
     */
    public function __construct(string $name, bool $ignoresPlayerLimit)
    {
        $this->name = $name;
        $this->ignoresPlayerLimit = $ignoresPlayerLimit;
    }
}