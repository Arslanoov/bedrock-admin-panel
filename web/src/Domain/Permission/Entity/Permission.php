<?php

declare(strict_types=1);

namespace Domain\Permission\Entity;

use Domain\Whitelist\Entity\Role;

final class Permission
{
    private string $xuid;
    private Role $permission;

    /**
     * Permission constructor.
     * @param string $xuid
     * @param Role $permission
     */
    public function __construct(string $xuid, Role $permission)
    {
        $this->xuid = $xuid;
        $this->permission = $permission;
    }

    /**
     * @return string
     */
    public function getXuid(): string
    {
        return $this->xuid;
    }

    /**
     * @return Role
     */
    public function getPermission(): Role
    {
        return $this->permission;
    }

    public function asArray(): array
    {
        return [
            'xuid' => $this->xuid,
            'permission' => $this->permission->getValue()
        ];
    }

    public function isEqual(Permission $permission): bool
    {
        return $this->xuid === $permission->getXuid();
    }
}