<?php

return [
    'server' => [
        'url' => 'http://' .  file_get_contents(__DIR__ . '/../../server.ip') . ':57152',
        'key' => file_get_contents(__DIR__ . '/../../.key')
    ]
];