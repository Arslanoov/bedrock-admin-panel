<?php

use App\Service\Server\McpeServerService;
use App\Service\Server\Properties\FilePropertiesService;
use App\Service\Server\Properties\PropertiesService;
use App\Service\Server\ServerService;
use App\Service\Server\Whitelist\DummyWhitelistService;
use App\Service\Server\Whitelist\FileWhitelistService;
use App\Service\Server\Whitelist\WhitelistService;
use Furious\Container\Container;

/** @var Container $container */

$container->set(WhitelistService::class, function (Container $container) {
    return $container->get(FileWhitelistService::class);
});

$container->set(PropertiesService::class, function (Container $container) {
    return $container->get(FilePropertiesService::class);
});

$container->set(ServerService::class, function (Container $container) {
    return $container->get(McpeServerService::class);
});