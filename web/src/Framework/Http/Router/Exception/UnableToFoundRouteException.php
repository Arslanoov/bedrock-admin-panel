<?php

declare(strict_types=1);

namespace Framework\Http\Router\Exception;

use LogicException;

final class UnableToFoundRouteException extends LogicException
{
    private string $name;
    private array $params;

    public function __construct($name, array $params = [])
    {
        parent::__construct();
        $this->message = 'Route "' . $name . '" not found.';
        $this->name = $name;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}