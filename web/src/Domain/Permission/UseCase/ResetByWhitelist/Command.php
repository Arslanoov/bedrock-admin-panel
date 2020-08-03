<?php

declare(strict_types=1);

namespace Domain\Permission\UseCase\ResetByWhitelist;

use Domain\Whitelist\Entity\Role;
use Domain\Whitelist\Entity\Whitelist;

final class Command
{
    public Whitelist $whitelist;
    public string $uuid;
    public Role $role;

    /**
     * Command constructor.
     * @param Whitelist $whitelist
     * @param string $uuid
     * @param Role $role
     */
    public function __construct(Whitelist $whitelist, string $uuid, Role $role)
    {
        $this->whitelist = $whitelist;
        $this->uuid = $uuid;
        $this->role = $role;
    }
}