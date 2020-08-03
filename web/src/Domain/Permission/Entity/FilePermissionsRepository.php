<?php

declare(strict_types=1);

namespace Domain\Permission\Entity;

final class FilePermissionsRepository implements PermissionsRepository
{
    private string $pathToFile;

    /**
     * FilePermissionsRepository constructor.
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function get(): Permissions
    {
        $json = file_get_contents($this->pathToFile);
        return new Permissions(json_decode($json, true));
    }
}