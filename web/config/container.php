<?php

use Furious\Container\Container;
use Psr\Container\ContainerInterface;

$container = new Container();

$config = [];
$configFiles = glob(__DIR__ . '/params/{*}.php', GLOB_BRACE);
foreach ($configFiles as $configFile) {
    $config += require $configFile;
}

$container->set('config', $config);
array_map(
    function ($file) use ($container) {
        return require $file;
    },
    glob(__DIR__ . '/dependencies/{*}.php', GLOB_BRACE)
);

$container->set(ContainerInterface::class, function (Container $container) {
    return $container;
});

return $container;