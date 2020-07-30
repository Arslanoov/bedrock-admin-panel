<?php

use App\Console\Commands;

return [
    'console' => [
        'commands' => [
            Commands\HelloCommand::class,
            Commands\Cycle\RunMigrationsCommand::class,
            Commands\Cycle\CreateMigrationCommand::class,
            Commands\User\CreateCommand::class
        ]
    ]
];