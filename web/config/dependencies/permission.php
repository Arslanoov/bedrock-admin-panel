<?php

use Domain\Permission\Entity\FilePermissionsRepository;
use Domain\Permission\Entity\PermissionsRepository;
use Domain\Permission\Service\FilePermissionsEditor;
use Domain\Permission\Service\PermissionsEditor;
use Furious\Container\Container;

/** @var Container $container */

$container->set(PermissionsRepository::class, function (Container $container) {
    return new FilePermissionsRepository(
        $container->get('config')['permission']['path']
    );
});

$container->set(PermissionsEditor::class, function (Container $container) {
    return new FilePermissionsEditor(
        $container->get('config')['permission']['path']
    );
});