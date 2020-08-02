<?php

declare(strict_types=1);

namespace Domain\Whitelist\Entity;

interface WhitelistRepository
{
    public function get(): Whitelist;
}