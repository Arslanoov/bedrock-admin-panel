<?php

declare(strict_types=1);

namespace App\Service\Server\Whitelist;

use Ramsey\Uuid\Uuid;

/**
 * Class DummyWhitelistService
 * @package App\Service\Server\Whitelist
 * Plug
 */
final class DummyWhitelistService implements WhitelistService
{
    public function getList(): array
    {
        return [
            [
                'name' => 'Player1',
                'uuid' => Uuid::uuid4()->toString()
            ],
            [
                'name' => 'Player2',
                'uuid' => Uuid::uuid4()->toString()
            ],
            [
                'name' => 'Player3',
                'uuid' => Uuid::uuid4()->toString()
            ]
        ];
    }

    public function addPlayer(string $name): void
    {
        $list = $this->getList();

        $list[] = [
            'name' => $name,
            'uuid' => Uuid::uuid4()->toString()
        ];

        echo "<pre>";var_dump($list);
    }

    public function removePlayer(string $name): void
    {
        $players = $this->getList();

        foreach ($players as $key => $player) {
            if ($player['name'] === $name) {
                unset($players[$key]);
            }
        }

        echo "<pre>";var_dump($players);
    }
}