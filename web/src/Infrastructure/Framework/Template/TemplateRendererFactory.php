<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Template;

use Psr\Container\ContainerInterface;
use Framework\Template\Twig\TwigRenderer;
use Twig\Environment;

final class TemplateRendererFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TwigRenderer(
            $container->get(Environment::class),
            $container->get('config')['templates']['extension']
        );
    }
}