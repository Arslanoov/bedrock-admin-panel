<?php

declare(strict_types=1);

use Furious\Container\Container;

$container = new Container();

function getConfig(): array
{
    $config = [];
    $files = glob(__DIR__ . '/params/{*}.php', GLOB_BRACE);

    foreach ($files as $file) {
        $config += require $file;
    }

    if (ENV === 'dev') {
        $config = array_replace($config, require __DIR__ . '/dev/params.php');
    }

    return $config;
}

$container->set('config', getConfig());

array_map(
    function ($file) use ($container) {
        return require $file;
    },
    glob(__DIR__ . '/dependencies/{*}.php', GLOB_BRACE)
);

if (ENV === 'dev') {
    require __DIR__ . '/dev/dependencies.php';
}

return $container;