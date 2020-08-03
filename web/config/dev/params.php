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
        'backupsPath' => '/app/dummy/backups'
    ],
    'logs' => [
        'url' => '/app/dummy/logs.txt'
    ],
    'server' => [
        'url' => 'http://localhost:57152',
        'key' => file_get_contents(__DIR__ . '/../../.key')
    ]
];