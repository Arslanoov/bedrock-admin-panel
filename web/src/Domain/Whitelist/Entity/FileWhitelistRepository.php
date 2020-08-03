<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

use Domain\Permission\Entity\Permissions;
use Domain\Permission\Entity\PermissionsRepository;
use Framework\Http\Exception\NotFoundException;

final class FileWhitelistRepository implements WhitelistRepository
{
    private PermissionsRepository $permissions;
    private string $pathToFile;

    /**
     * FileWhitelistRepository constructor.
     * @param PermissionsRepository $permissions
     * @param string $pathToFile
     */
    public function __construct(PermissionsRepository $permissions, string $pathToFile)
    {
        $this->permissions = $permissions;
        $this->pathToFile = $pathToFile;
    }

    public function get(): Whitelist
    {
        $permissions = $this->permissions->get();
        $json = file_get_contents($this->pathToFile);
        $whitelist = new Whitelist(json_decode($json, true));

        foreach ($whitelist->getPlayers() as $player) {
            if ($player->getXuid() and $permission = $permissions->findPermissionByXuid($player->getXuid())) {
                $whitelist->removePlayer($player);
                $player->changeRole($permission->getPermission());
                $whitelist->addPlayer($player);
            }
        }

        return $whitelist;
    }

    public function getByUuid(string $uuid): array
    {
        $permissions = $this->permissions->get();

        $players = $this->get()->getPlayers();
        foreach ($players as $player) {
            if ($player->getUuid() === $uuid) {
                if ($permission = $permissions->findPermissionByXuid($player->getXuid())) {
                    $player->changeRole($permission->getPermission());
                } else {
                    $player->resetRole();
                }
                return $player->asArray();
            }
        }

        throw new NotFoundException('Whitelist player not found.');
    }
}