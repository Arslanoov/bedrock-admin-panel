<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

use Ramsey\Uuid\Uuid;

final class Player
{
    private string $name;
    private string $uuid;

    /**
     * Player constructor.
     * @param string $name
     * @param string $uuid
     */
    public function __construct(string $name, string $uuid)
    {
        $this->name = $name;
        $this->uuid = $uuid;
    }

    public static function new(string $name): self
    {
        return new self(
            $name,
            Uuid::uuid4()->toString()
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function asArray(): array
    {
        return [
            'name' => $this->name,
            'uuid' => $this->uuid
        ];
    }

    public function isEqual(Player $player): bool
    {
        return
            $this->name === $player->getName() and
            $this->uuid === $player->getUuid();
    }
}