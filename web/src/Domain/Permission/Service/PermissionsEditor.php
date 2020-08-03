<?php

declare(strict_types=1);

namespace Domain\Permission\Service;

use Domain\Permission\Entity\Permissions;

interface PermissionsEditor
{
    public function edit(Permissions $permissions): void;
}