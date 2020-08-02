<?php

use App\Service\ChangeRightServiceInterface;
use App\Service\DummyChangeRightService;
use Furious\Container\Container;

/** @var Container $container */

$container->set(ChangeRightServiceInterface::class, function (Container $container) {
    return $container->get(DummyChangeRightService::class);
});