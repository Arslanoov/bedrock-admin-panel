<?php

use App\Service\Server\McpeServerService;
use App\Service\Server\Properties\FilePropertiesService;
use App\Service\Server\Properties\PropertiesService;
use App\Service\Server\ServerService;
use App\Service\Server\Whitelist\DummyWhitelistService;
use App\Service\Server\Whitelist\FileWhitelistService;
use App\Service\Server\Whitelist\WhitelistService;
use App\Service\Server\World\McpeWorldUploader;
use App\Service\Server\World\WorldUploader;
use App\Service\Zip\UnzipService;
use App\Service\Zip\UnzipServiceInterface;
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

$container->set(UnzipServiceInterface::class, function (Container $container) {
    return $container->get(UnzipService::class);
});

$container->set(WorldUploader::class, function (Container $container) {
    return $container->get(McpeWorldUploader::class);
});