<?php

declare(strict_types=1);

namespace Domain\Permission\Entity;

interface PermissionsRepository
{
    public function get(): Permissions;
}