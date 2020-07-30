<?php

declare(strict_types=1);

namespace Framework\Template\Twig;

use Framework\Template\TemplateRenderer;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TwigRenderer implements TemplateRenderer
{
    private Environment $twig;
    private ?string $extension;

    public function __construct(Environment $twig, ?string $extension)
    {
        $this->twig = $twig;
        $this->extension = $extension;
    }

    /**
     * @param $name
     * @param array $params
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render($name, array $params = []): string
    {
        return $this->twig->render($name . $this->extension, $params);
    }
}