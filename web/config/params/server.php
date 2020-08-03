<?php

return [
    'server' => [
        'url' => 'http://' . $_SERVER['REMOTE_ADDR'] .  $_SERVER['SERVER_NAME'] . ':57152',
        'key' => file_get_contents(__DIR__ . '/../../.key')
    ]
];