<?php

use App\Service\ChangeRightServiceInterface;
use App\Service\FileService;
use App\Service\FileServiceInterface;
use App\Service\Logs\FileLogsService;
use App\Service\Logs\LogsService;
use App\Service\Server\McpeServerService;
use App\Service\Server\ServerService;
use App\Service\Server\World\McpeWorldBackupRemover;
use App\Service\Server\World\McpeWorldRemover;
use App\Service\Server\World\McpeWorldTimestampBackupMaker;
use App\Service\Server\World\McpeWorldUploader;
use App\Service\Server\World\WorldBackupMaker;
use App\Service\Server\World\WorldBackupRemover;
use App\Service\Server\World\WorldRemover;
use App\Service\Server\World\WorldUploader;
use App\Service\WorldsChangeRightService;
use App\Service\Zip\UnzipService;
use App\Service\Zip\UnzipServiceInterface;
use App\Service\Zip\ZipService;
use App\Service\Zip\ZipServiceInterface;
use Furious\Container\Container;

/** @var Container $container */

$container->set(ServerService::class, function (Container $container) {
    return new McpeServerService(
        $container->get('config')['server']['url'],
        $container->get('config')['server']['key']
    );
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

$container->set(WorldBackupMaker::class, function (Container $container) {
    return new McpeWorldTimestampBackupMaker(
        $container->get('config')['world']['path'],
        $container->get('config')['world']['name'],
        $container->get('config')['world']['backupsPath'],
    );
});

$container->set(FileServiceInterface::class, function (Container $container) {
    return new FileService(
        $container->get('config')['world']['backupsPath']
    );
});

$container->set(ZipServiceInterface::class, function (Container $container) {
    return new ZipService(
        $container->get(ZipArchive::class),
        $container->get('config')['world']['backupsPath']
    );
});

$container->set(WorldBackupRemover::class, function (Container $container) {
    return new McpeWorldBackupRemover(
        $container->get('config')['world']['backupsPath']
    );
});

$container->set(LogsService::class, function (Container $container) {
    return new FileLogsService(
        $container->get('config')['logs']['url']
    );
});