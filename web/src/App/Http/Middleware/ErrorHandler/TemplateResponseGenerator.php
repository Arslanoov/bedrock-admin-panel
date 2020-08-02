<?php

declare(strict_types=1);

namespace App\Http\Middleware\ErrorHandler;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

final class TemplateResponseGenerator implements ResponseGenerator
{
    private ResponseInterface $response;
    private TemplateRenderer $template;
    private array $views;

    /**
     * TemplateResponseGenerator constructor.
     * @param ResponseInterface $response
     * @param TemplateRenderer $template
     * @param array $views
     */
    public function __construct(ResponseInterface $response, TemplateRenderer $template, array $views)
    {
        $this->response = $response;
        $this->template = $template;
        $this->views = $views;
    }

    public function generate(Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        $code = $this->getStatusCode($e);

        $response = $this->response->withStatus($code);

        if (!$view = $this->views[$code]) {
            $view = $this->views[500];
        }

        $response
            ->getBody()
            ->write(
                $this->template->render($view)
            )
        ;

        return $response;
    }

    private function getStatusCode(Throwable $e): int
    {
        $errorCode = $e->getCode();
        if ($errorCode >= 400 and $errorCode < 600) {
            return $errorCode;
        }

        $status = $this->response->getStatusCode();
        if (!$status or $status < 400 or $status >= 600) {
            $status = 500;
        }

        return $status;
    }
}