<?php

return [
    'logs' => [
        'url' => 'http://' .  trim(file_get_contents(__DIR__ . '/../../server.ip')) . ':57152/logs.php?key=' . file_get_contents(__DIR__ . '/../../.key')
    ]
];