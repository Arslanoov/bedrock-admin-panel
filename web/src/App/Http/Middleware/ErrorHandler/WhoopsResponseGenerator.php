<?php

declare(strict_types=1);

namespace App\Http\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Whoops\Handler\PrettyPageHandler;
use Whoops\RunInterface;

final class WhoopsResponseGenerator implements ResponseGenerator
{
    private RunInterface $whoops;
    private ResponseInterface $response;

    public function __construct(RunInterface $whoops, ResponseInterface $response)
    {
        $this->whoops = $whoops;
        $this->response = $response;
    }

    public function generate(Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->whoops->getHandlers() as $handler) {
            if ($handler instanceof PrettyPageHandler) {
                $this->prepareWhoopsHandler($request, $handler);
            }
        }

        $response = $this->response->withStatus($this->getStatusCode($e));

        $response
            ->getBody()
            ->write($this->whoops->handleException($e))
        ;

        return $response;
    }

    private function prepareWhoopsHandler(ServerRequestInterface $request, PrettyPageHandler $handler): void
    {
        $handler->addDataTable('Application Request', [
            'HTTP Method'            => $request->getMethod(),
            'URI'                    => (string) $request->getUri(),
            'Script'                 => $request->getServerParams()['SCRIPT_NAME'],
            'Headers'                => $request->getHeaders(),
            'Cookies'                => $request->getCookieParams(),
            'Attributes'             => $request->getAttributes(),
            'Query String Arguments' => $request->getQueryParams(),
            'Body Params'            => $request->getParsedBody(),
        ]);
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