<?php

declare(strict_types=1);

namespace App\Service\Server\Properties\Info;

use Webmozart\Assert\Assert;

final class MainInfo
{
    public string $serverName;
    public int $maxPlayers;
    public bool $onlineMode;
    public bool $whiteList;

    /**
     * MainInfo constructor.
     * @param string $serverName
     * @param int $maxPlayers
     * @param bool $onlineMode
     * @param bool $whiteList
     */
    public function __construct(string $serverName, int $maxPlayers, bool $onlineMode, bool $whiteList)
    {
        Assert::string($serverName);
        Assert::notEmpty($serverName);
        $this->serverName = $serverName;
        Assert::integer($maxPlayers);
        Assert::greaterThan($maxPlayers, 0);
        $this->maxPlayers = $maxPlayers;
        Assert::boolean($onlineMode);
        $this->onlineMode = $onlineMode;
        Assert::boolean($whiteList);
        $this->whiteList = $whiteList;
    }
}