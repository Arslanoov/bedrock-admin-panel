<?php

declare(strict_types=1);

namespace Domain\Properties\UseCase\Edit;

use Domain\Properties\Entity\Properties;
use Domain\Properties\Service\PropertiesEditor;

final class Handler
{
    private PropertiesEditor $editor;

    /**
     * Handler constructor.
     * @param PropertiesEditor $editor
     */
    public function __construct(PropertiesEditor $editor)
    {
        $this->editor = $editor;
    }

    public function handle(Command $command): void
    {
        $this->editor->edit(
            new Properties(
                $command->mainInfo,
                $command->portInfo,
                $command->movementInfo,
                $command->worldInfo,
                $command->otherInfo
            )
        );
    }
}