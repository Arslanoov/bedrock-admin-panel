<?php

declare(strict_types=1);

namespace App\Service\Server\Whitelist;

use Ramsey\Uuid\Uuid;

final class FileWhitelistService implements WhitelistService
{
    private const WHITELIST_PATH = '/app/data/whitelist.json';

    public function getList(): array
    {
        $json = file_get_contents(self::WHITELIST_PATH);
        return json_decode($json, true);
    }

    public function addPlayer(string $name): void
    {
        $list = $this->getList();

        $list[] = [
            'name' => $name,
            'uuid' => Uuid::uuid4()->toString()
        ];

        file_put_contents(self::WHITELIST_PATH, json_encode($list));
    }

    public function removePlayer(string $name): void
    {
        $players = $this->getList();

        foreach ($players as $key => $player) {
            if ($player['name'] === $name) {
                unset($players[$key]);
            }
        }

        file_put_contents(self::WHITELIST_PATH, json_encode($players));
    }
}