<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

use Ramsey\Uuid\Uuid;

final class Player
{
    private string $name;
    private string $uuid;
    public ?string $xuid;
    private Role $role;
    private bool $ignoresPlayerLimit;

    public function __construct(string $name, string $uuid, ?string $xuid, Role $role, bool $ignoresPlayerLimit)
    {
        $this->name = $name;
        $this->uuid = $uuid;
        $this->xuid = $xuid;
        $this->role = $role;
        $this->ignoresPlayerLimit = $ignoresPlayerLimit;
    }

    public static function new(string $name, Role $role, bool $ignoresPlayerLimit, ?string $xuid = null): self
    {
        return new self(
            $name,
            Uuid::uuid4()->toString(),
            $xuid,
            $role,
            $ignoresPlayerLimit
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

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getXuid(): ?string
    {
        return $this->xuid;
    }

    /**
     * @return bool
     */
    public function isIgnoresPlayerLimit(): bool
    {
        return $this->ignoresPlayerLimit;
    }

    public function asArray(): array
    {
        return [
            'name' => $this->name,
            'uuid' => $this->uuid,
            'ignoresPlayerLimit' => $this->ignoresPlayerLimit ? 'true' : 'false',
            'xuid' => $this->xuid ?: ''
        ];
    }

    public function isEqual(Player $player): bool
    {
        return
            $this->name === $player->getName() and
            $this->uuid === $player->getUuid()
        ;
    }
}