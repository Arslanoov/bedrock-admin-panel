<?php

declare(strict_types=1);

namespace Domain\Whitelist\Service;

use Domain\Whitelist\Entity\Whitelist;

final class FileWhitelistEditor implements WhitelistEditor
{
    private string $pathToFile;

    /**
     * FileWhitelistEditor constructor.
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function edit(Whitelist $whitelist): void
    {
        $players = $whitelist->getPlayersArray();
        file_put_contents($this->pathToFile, json_encode($players));
    }
}