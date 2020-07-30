<?php

declare(strict_types=1);

namespace Framework\Http\Router;

final class Result
{
    private string $routeName;
    private string $action;
    private array $params;

    /**
     * RouteMatch constructor.
     * @param string $routeName
     * @param string $action
     * @param array $params
     */
    public function __construct(string $routeName, string $action, array $params)
    {
        $this->routeName = $routeName;
        $this->action = $action;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}