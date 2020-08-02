<?php

use App\Service\ChangeRightServiceInterface;
use App\Service\Server\McpeServerService;
use App\Service\Server\ServerService;
use App\Service\Server\World\McpeWorldRemover;
use App\Service\Server\World\McpeWorldUploader;
use App\Service\Server\World\WorldRemover;
use App\Service\Server\World\WorldUploader;
use App\Service\WorldsChangeRightService;
use App\Service\Zip\UnzipService;
use App\Service\Zip\UnzipServiceInterface;
use Furious\Container\Container;

/** @var Container $container */

$container->set(ServerService::class, function (Container $container) {
    return $container->get(McpeServerService::class);
});

$container->set(ChangeRightServiceInterface::class, function (Container $container) {
    return $container->get(WorldsChangeRightService::class);
});

$container->set(UnzipServiceInterface::class, function (Container $container) {
    return new UnzipService(
        $container->get(ZipArchive::class),
        $container->get(ChangeRightServiceInterface::class),
        $container->get('config')['world']['path'],
        $container->get('config')['world']['name'],
        $container->get('config')['server']['url']
    );
});

$container->set(WorldUploader::class, function (Container $container) {
    return new McpeWorldUploader(
        $container->get(ChangeRightServiceInterface::class),
        $container->get('config')['world']['path'],
        $container->get('config')['server']['url']
    );
});

$container->set(WorldRemover::class, function (Container $container) {
    return new McpeWorldRemover(
        $container->get(ChangeRightServiceInterface::class),
        $container->get('config')['server']['url'],
        $container->get('config')['world']['path'],
        $container->get('config')['world']['name']
    );
});