<?php

declare(strict_types=1);

namespace Domain\Permission\UseCase\ResetByWhitelist;

use Domain\Permission\Entity\Permissions;
use Domain\Permission\Entity\PermissionsRepository;
use Domain\Permission\Service\PermissionsEditor;

final class Handler
{
    private PermissionsRepository $permissions;
    private PermissionsEditor $editor;

    /**
     * Handler constructor.
     * @param PermissionsRepository $permissions
     * @param PermissionsEditor $editor
     */
    public function __construct(PermissionsRepository $permissions, PermissionsEditor $editor)
    {
        $this->permissions = $permissions;
        $this->editor = $editor;
    }

    public function handle(Command $command): void
    {
        $permissions = [];

        $whitelistPlayers = $command->whitelist->getPlayers();
        foreach ($whitelistPlayers as $whitelistPlayer) {
            if (
                $whitelistPlayer->getUuid() !== $command->uuid and
                !$whitelistPlayer->getRole()->isDefault()
            ) {
                $permissions[] = [
                    'xuid' => $whitelistPlayer->getXuid(),
                    'permission' => $whitelistPlayer->getRole()->getValue()
                ];
            } elseif (
                !empty($whitelistPlayer->getXuid()) and
                !$command->role->isDefault()
            ) {
                $permissions[] = [
                    'xuid' => $whitelistPlayer->getXuid(),
                    'permission' => $command->role->getValue()
                ];
            }
        }

        $this->editor->edit(
            new Permissions($permissions)
        );
    }
}