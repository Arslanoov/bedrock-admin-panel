<?php

use Framework\Http\Psr7\LaminasResponseFactory;
use Framework\Http\Psr7\ResponseFactory;
use App\Http\Middleware\ErrorHandler;
use Framework\Template\TemplateRenderer;
use Furious\Container\Container;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/** @var Container $container */

$container->set(ContainerInterface::class, function (Container $container) {
    return $container;
});

$container->set(ResponseFactory::class, function (Container $container) {
    return $container->get(LaminasResponseFactory::class);
});

$container->set(ErrorHandler::class, function (Container $container) {
    return new ErrorHandler(
        $container->get(ResponseFactory::class),
        $container->get(TemplateRenderer::class),
        boolval($container->get('config')['debug'])
    );
});

$container->set(ServerRequestInterface::class, function (Container $container) {
    return (new ServerRequestFactory)->fromGlobals();
});