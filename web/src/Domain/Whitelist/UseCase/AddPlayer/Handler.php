<?php

declare(strict_types=1);

namespace Domain\Whitelist\UseCase\AddPlayer;

use Domain\Whitelist\Entity\Player;
use Domain\Whitelist\Entity\Role;
use Domain\Whitelist\Entity\WhitelistRepository;
use Domain\Whitelist\Service\WhitelistEditor;

final class Handler
{
    private WhitelistRepository $whitelist;
    private WhitelistEditor $editor;

    /**
     * Handler constructor.
     * @param WhitelistRepository $whitelist
     * @param WhitelistEditor $editor
     */
    public function __construct(WhitelistRepository $whitelist, WhitelistEditor $editor)
    {
        $this->whitelist = $whitelist;
        $this->editor = $editor;
    }

    public function handle(Command $command): void
    {
        $whitelist = $this->whitelist->get();

        $whitelist->addPlayer(
            Player::new(
                $command->name, new Role('default'),
                $command->ignoresPlayerLimit
            )
        );

        $this->editor->edit($whitelist);
    }
}