<?php

declare(strict_types=1);

namespace Framework\Template;

interface TemplateRenderer
{
    public function render($name, array $params = []): string;
}