<?php

use App\Http\Middleware\NotFoundHandler;
use Framework\Http\Application;
use Framework\Http\Pipeline\FuriousPipelineAdapter;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\FuriousRouterAdapter;
use Framework\Http\Router\Router;
use Furious\Container\Container;

/** @var Container $container */

$container->set(Router::class, function (Container $container) {
    return $container->get(FuriousRouterAdapter::class);
});

$container->set(MiddlewareResolver::class, function (Container $container) {
    return new MiddlewareResolver($container);
});

$container->set(Application::class, function (Container $container) {
    return new Application(
        $container->get(MiddlewareResolver::class),
        $container->get(Router::class),
        $container->get(NotFoundHandler::class),
        $container->get(FuriousPipelineAdapter::class)
    );
});