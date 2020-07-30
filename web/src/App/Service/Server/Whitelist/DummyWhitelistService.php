<?php

declare(strict_types=1);

namespace App\Service\Server\Whitelist;

final class DummyWhitelistService implements WhitelistService
{
    public function getList(): array
    {
        return [
            [
                'name' => 'Player1'
            ],
            [
                'name' => 'Player2'
            ],
            [
                'name' => 'Player3'
            ]
        ];
    }
}