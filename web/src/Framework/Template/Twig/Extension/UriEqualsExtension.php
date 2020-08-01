<?php

declare(strict_types=1);

namespace Framework\Template\Twig\Extension;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class UriEqualsExtension extends AbstractExtension
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
            new TwigFunction('uriEquals', [$this, 'equals']),
        ];
    }

    public function equals(string $inputUri): bool
    {
        /** @var ServerRequestInterface $request */
        $request = $this->container->get(ServerRequestInterface::class);
        $uri = (string) $request->getUri();
        return $inputUri === $uri;
    }
}