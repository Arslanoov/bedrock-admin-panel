<?php

declare(strict_types=1);

namespace Domain\Whitelist\Service;

use Domain\Whitelist\Entity\Whitelist;

interface WhitelistEditor
{
    public function edit(Whitelist $whitelist): void;
}