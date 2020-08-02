<?php

declare(strict_types=1);

namespace Domain\Properties\Entity;

use Webmozart\Assert\Assert;

final class WorldInfo
{
    private const GAMEMODE_LIST = ['survival', 'creative', 'adventure'];
    private const DIFFICULTY_LIST = ['peaceful', 'easy', 'normal', 'hard'];
    private const PERMISSIONS = ['visitor', 'member', 'operator'];

    public string $gamemode;
    public string $difficulty;
    public bool $allowCheats;
    public int $viewDistance;
    public int $tickDistance;
    public string $worldSeed;
    public string $defaultPlayerPermission;
    public bool $texturePackRequired;

    /**
     * WorldInfo constructor.
     * @param string $gamemode
     * @param string $difficulty
     * @param bool $allowCheats
     * @param int $viewDistance
     * @param int $tickDistance
     * @param string $worldSeed
     * @param string $defaultPlayerPermission
     * @param bool $texturePackRequired
     */
    public function __construct(
        string $gamemode, string $difficulty, bool $allowCheats,
        int $viewDistance, int $tickDistance, string $worldSeed,
        string $defaultPlayerPermission, bool $texturePackRequired
    )
    {
        Assert::string($gamemode);
        Assert::oneOf(trim($gamemode), self::GAMEMODE_LIST);
        $this->gamemode = trim($gamemode);
        Assert::string($difficulty);
        Assert::oneOf(trim($difficulty), self::DIFFICULTY_LIST);
        $this->difficulty = trim($difficulty);
        Assert::boolean($allowCheats);
        $this->allowCheats = $allowCheats;
        Assert::integer($viewDistance);
        Assert::greaterThan($viewDistance, 0);
        $this->viewDistance = $viewDistance;
        Assert::integer($tickDistance);
        Assert::greaterThan($tickDistance, 3);
        Assert::lessThan($tickDistance, 13);
        $this->tickDistance = $tickDistance;
        Assert::string($worldSeed);
        $this->worldSeed = $worldSeed;
        Assert::string($defaultPlayerPermission);
        Assert::oneOf(trim($defaultPlayerPermission), self::PERMISSIONS);
        $this->defaultPlayerPermission = trim($defaultPlayerPermission);
        Assert::boolean($texturePackRequired);
        $this->texturePackRequired = $texturePackRequired;
    }
}