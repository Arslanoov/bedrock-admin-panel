<?php

declare(strict_types=1);

namespace Domain\Permission\Entity;

use Domain\Whitelist\Entity\Role;

final class Permissions
{
    /** @var array|Permission[] */
    private array $permissions = [];

    /**
     * Permissions constructor.
     * @param array $permissions
     */
    public function __construct(array $permissions = [])
    {
        foreach ($permissions as $permission) {
            $this->addPermission(new Permission(
                $permission['xuid'],
                new Role($permission['permission'])
            ));
        }
    }

    public function asArray(): array
    {
        $permissions = [];

        /** @var Permission $permission */
        foreach ($this->permissions as $permission) {
            $permissions[] = $permission->asArray();
        }

        return $permissions;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function findPermissionByXuid(string $xuid): ?Permission
    {
        foreach ($this->permissions as $permission) {
            if ($permission->getXuid() === $xuid) {
                return $permission;
            }
        }

        return null;
    }

    public function addPermission(Permission $permission): void
    {
        $this->permissions[] = $permission;
    }

    public function removePermission(Permission $permission): void
    {
        foreach ($this->permissions as $key => $currentPermission) {
            if ($currentPermission->isEqual($permission)) {
                unset($this->permissions[$key]);
            }
        }
    }
}