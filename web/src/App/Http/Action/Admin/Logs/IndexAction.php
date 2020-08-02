<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Logs;

use App\Service\Logs\LogsService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private LogsService $logs;

    /**
     * IndexAction constructor.
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param LogsService $logs
     */
    public function __construct(ResponseFactory $response, TemplateRenderer $template, LogsService $logs)
    {
        $this->response = $response;
        $this->template = $template;
        $this->logs = $logs;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $logs = $this->logs->get();

        return $this->response->html(
            $this->template->render('admin/logs/index', [
                'logs' => $logs
            ])
        );
    }
}