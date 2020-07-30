<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Template;

use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

final class TwigEnvironmentFactory
{
    /**
     * @param ContainerInterface $container
     * @return Environment
     * @throws LoaderError
     */
    public function __invoke(ContainerInterface $container)
    {
        $debug = $container->get('config')['debug'];
        $config = $container->get('config')['templates']['twig'];

        $loader = new FilesystemLoader();
        $loader->addPath($config['template_dir']);

        $environment = new Environment($loader, [
            'cache' => $debug ? false : $config['cache_dir'],
            'debug' => $debug,
            'strict_variables' => $debug,
            'auto_reload' => $debug,
        ]);

        if ($debug) {
            $environment->addExtension(new DebugExtension());
        }

        foreach ($config['extensions'] as $extension) {
            $environment->addExtension($container->get($extension));
        }

        return $environment;
    }
}