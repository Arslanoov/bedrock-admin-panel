<?php

use Furious\Container\Container;
use Framework\Template\TemplateRenderer;
use Infrastructure\Framework\Template\TemplateRendererFactory;
use Infrastructure\Framework\Template\TwigEnvironmentFactory;
use Twig\Environment;

/** @var Container $container */

$container->set(TemplateRenderer::class, function (Container $container) {
    return (new TemplateRendererFactory)($container);
});

$container->set(Environment::class, function (Container $container) {
    return (new TwigEnvironmentFactory)($container);
});