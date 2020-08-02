<?php

use App\Http\Middleware\ErrorHandler\ResponseGenerator;
use App\Http\Middleware\ErrorHandler\TemplateResponseGenerator;
use App\Http\Middleware\ErrorHandler\WhoopsResponseGenerator;
use Framework\Http\Psr7\LaminasResponseFactory;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Furious\Container\Container;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Whoops\Run;
use Whoops\RunInterface;

/** @var Container $container */

$container->set(ContainerInterface::class, function (Container $container) {
    return $container;
});

$container->set(ResponseFactory::class, function (Container $container) {
    return $container->get(LaminasResponseFactory::class);
});

### Error handler

$container->set(RunInterface::class, function (Container $container) {
    $run = new Run();
    $run->writeToOutput(false);
    $run->allowQuit(false);
    $run->pushHandler(new Whoops\Handler\PrettyPageHandler());
    $run->register();
    return $run;
});

$container->set(TemplateResponseGenerator::class, function (Container $container) {
    return new TemplateResponseGenerator(
        $container->get(ResponseInterface::class),
        $container->get(TemplateRenderer::class),
        $container->get('config')['templates']['errors']
    );
});

$container->set(ResponseGenerator::class, function (Container $container) {
    if ($container->get('config')['debug'] == 'true') {
        return $container->get(WhoopsResponseGenerator::class);
    }
    return $container->get(TemplateResponseGenerator::class);
});

### PSR-7

$container->set(ServerRequestInterface::class, function (Container $container) {
    return (new ServerRequestFactory)->fromGlobals();
});

$container->set(ResponseInterface::class, function (Container $container) {
    return $container->get(Response::class);
});