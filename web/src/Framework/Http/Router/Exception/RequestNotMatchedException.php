<?php

declare(strict_types=1);

namespace Framework\Http\Router\Exception;

use LogicException;
use Psr\Http\Message\ServerRequestInterface;

final class RequestNotMatchedException extends LogicException
{
    private ServerRequestInterface $request;

    /**
     * RequestNotMatchedException constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct();
        $this->message = 'Route matches not found';
        $this->request = $request;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}