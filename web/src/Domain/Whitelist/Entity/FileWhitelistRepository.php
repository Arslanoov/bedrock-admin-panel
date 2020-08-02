<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

final class FileWhitelistRepository implements WhitelistRepository
{
    private string $pathToFile;

    /**
     * FileWhitelistRepository constructor.
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function get(): Whitelist
    {
        $json = file_get_contents($this->pathToFile);
        return new Whitelist(json_decode($json, true));
    }
}