<?php

use Domain\Whitelist\Entity\FileWhitelistRepository;
use Domain\Whitelist\Entity\WhitelistRepository;
use Domain\Whitelist\Service\FileWhitelistEditor;
use Domain\Whitelist\Service\WhitelistEditor;
use Furious\Container\Container;

/** @var Container $container */

$container->set(WhitelistEditor::class, function (Container $container) {
    return new FileWhitelistEditor(
        $container->get('config')['whitelist']['pathToFile']
    );
});

$container->set(WhitelistRepository::class, function (Container $container) {
    return new FileWhitelistRepository(
        $container->get('config')['whitelist']['pathToFile']
    );
});
