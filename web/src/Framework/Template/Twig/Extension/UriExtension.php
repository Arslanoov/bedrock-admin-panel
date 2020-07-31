<?php

declare(strict_types=1);

namespace Framework\Template\Twig\Extension;

use Furious\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class UriExtension extends AbstractExtension
{
    private ContainerInterface $container;

    /**
     * UriExtension constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uri', [$this, 'getUri']),
        ];
    }

    public function getUri(): string
    {
        /** @var ServerRequest $request */
        $request = $this->container->get(ServerRequest::class);
        return (string) $request->getUri();
    }
}