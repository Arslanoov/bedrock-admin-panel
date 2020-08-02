<?php

declare(strict_types=1);

namespace App\Http\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

interface ResponseGenerator
{
    public function generate(Throwable $e, ServerRequestInterface $request): ResponseInterface;
}