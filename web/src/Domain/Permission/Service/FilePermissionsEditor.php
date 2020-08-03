<?php

declare(strict_types=1);

namespace Domain\Permission\Service;

use Domain\Permission\Entity\Permissions;

final class FilePermissionsEditor implements PermissionsEditor
{
    public string $pathToFile;

    /**
     * FilePermissionsEditor constructor.
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function edit(Permissions $permissions): void
    {
        file_put_contents($this->pathToFile, json_encode($permissions->asArray()));
    }
}