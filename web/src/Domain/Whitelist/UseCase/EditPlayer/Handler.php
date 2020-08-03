<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\EditPlayer;

use Domain\Whitelist\Entity\Role;
use Domain\Whitelist\Entity\WhitelistRepository;
use Domain\Whitelist\Service\WhitelistEditor;

final class Handler
{
    private WhitelistEditor $editor;
    private WhitelistRepository $whitelist;

    /**
     * Handler constructor.
     * @param WhitelistEditor $editor
     * @param WhitelistRepository $whitelist
     */
    public function __construct(WhitelistEditor $editor, WhitelistRepository $whitelist)
    {
        $this->editor = $editor;
        $this->whitelist = $whitelist;
    }

    public function handle(Command $command): void
    {
        $whitelist = $this->whitelist->get();

        $whitelist->editPlayerByUuid(
            $command->uuid,
            new Role($command->newRole),
            $command->newIgnoresPlayerLimit
        );

        $this->editor->edit($whitelist);
    }
}