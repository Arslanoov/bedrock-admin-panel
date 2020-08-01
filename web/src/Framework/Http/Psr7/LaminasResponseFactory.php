<?php

declare(strict_types=1);

namespace Framework\Http\Psr7;

use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\TextResponse;
use Laminas\Diactoros\Response\XmlResponse;
use Psr\Http\Message\ResponseInterface;

final class LaminasResponseFactory implements ResponseFactory
{
    public function html(string $html, int $code = 200): ResponseInterface
    {
        return new HtmlResponse($html, $code);
    }

    public function json(array $data, int $code = 200): ResponseInterface
    {
        return new JsonResponse($data, $code);
    }

    public function xml($data, int $code = 200): ResponseInterface
    {
        return new XmlResponse($data, $code);
    }

    public function text(string $text, int $code = 200): ResponseInterface
    {
        return new TextResponse($text, $code);
    }

    public function empty(): ResponseInterface
    {
        return new EmptyResponse();
    }

    public function redirect(string $uri, int $code = 302): ResponseInterface
    {
        return new RedirectResponse($uri, $code);
    }
}