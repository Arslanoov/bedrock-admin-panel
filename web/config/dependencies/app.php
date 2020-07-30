<?php

use Framework\Http\Psr7\FuriousResponseFactory;
use Framework\Http\Psr7\ResponseFactory;
use App\Http\Middleware\ErrorHandler;
use Framework\Template\TemplateRenderer;
use Furious\Container\Container;

/** @var Container $container */

$container->set(ResponseFactory::class, function (Container $container) {
    return $container->get(FuriousResponseFactory::class);
});

$container->set(ErrorHandler::class, function (Container $container) {
    return new ErrorHandler(
        $container->get(ResponseFactory::class),
        $container->get(TemplateRenderer::class),
        boolval($container->get('config')['debug'])
    );
});