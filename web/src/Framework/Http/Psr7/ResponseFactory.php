<?php

declare(strict_types=1);

namespace Framework\Http\Psr7;

use Psr\Http\Message\ResponseInterface;

interface ResponseFactory
{
    public function html(string $html, int $code = 200): ResponseInterface;

    public function json(array $data, int $code = 200): ResponseInterface;

    public function xml($data, int $code = 200): ResponseInterface;

    public function empty(): ResponseInterface;

    public function text(string $text): ResponseInterface;

    public function redirect(string $uri, int $code = 302): ResponseInterface;
}