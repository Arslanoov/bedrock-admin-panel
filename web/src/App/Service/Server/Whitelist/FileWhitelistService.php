<?php

declare(strict_types=1);

namespace App\Service\Server\Whitelist;

final class FileWhitelistService implements WhitelistService
{
    public function getList(): array
    {
        $json = file_get_contents('/opt/mcpe-data/whitelist.json');
        return json_decode($json, true);
    }
}