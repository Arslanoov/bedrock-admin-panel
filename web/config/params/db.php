<?php

use Spiral\Database;

return [
    'db' => [
        'default_connection' => 'postgres',
        'connections' => [
            'postgres' => [
                'driver'  => Database\Driver\Postgres\PostgresDriver::class,
                'connection' => 'pgsql:host=postgres;dbname=dbname',
                'username'   => 'username',
                'password'   => 'password'
            ]
        ]
    ]
];