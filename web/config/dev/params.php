<?php

return [
    'debug' => true,
    'whitelist' => [
        'pathToFile' => '/app/dummy/whitelist.json'
    ],
    'properties' => [
        'pathToFile' => '/app/dummy/properties.txt'
    ],
    'world' => [
        'path' => '/app/dummy/worlds',
        'name' => 'level',
        'name2' => 'level1',
        'backupsPath' => '/app/dummy/backups'
    ],
    'permission' => [
        'path' => '/app/dummy/permissions.json'
    ],
    'logs' => [
        'url' => '/app/dummy/logs.txt'
    ],
    'server' => [
        'url' => 'http://localhost:57152',
        'key' => file_get_contents(__DIR__ . '/../../.key')
    ]
];