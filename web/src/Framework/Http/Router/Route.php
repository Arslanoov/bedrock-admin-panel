<?php

declare(strict_types=1);

namespace Framework\Http\Router;

final class Route
{
    public string $name;
    public string $path;
    public string $action;
    public array $methods;
    public array $options;

    public function __construct(string $name, string $path, string $action, array $methods, array $options = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->action = $action;
        $this->methods = $methods;
        $this->options = $options;
    }
}