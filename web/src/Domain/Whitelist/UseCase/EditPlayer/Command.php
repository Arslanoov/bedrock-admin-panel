<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\EditPlayer;

final class Command
{
    public string $uuid;
    public string $newRole;
    public bool $newIgnoresPlayerLimit;

    /**
     * Command constructor.
     * @param string $uuid
     * @param string $newRole
     * @param bool $newIgnoresPlayerLimit
     */
    public function __construct(string $uuid, string $newRole, bool $newIgnoresPlayerLimit)
    {
        $this->uuid = $uuid;
        $this->newRole = $newRole;
        $this->newIgnoresPlayerLimit = $newIgnoresPlayerLimit;
    }
}