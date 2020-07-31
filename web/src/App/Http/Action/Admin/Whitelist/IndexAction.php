<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist;

use App\Service\Server\Whitelist\WhitelistService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private WhitelistService $whitelist;
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * IndexAction constructor.
     * @param WhitelistService $whitelist
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(WhitelistService $whitelist, ResponseFactory $response, TemplateRenderer $template)
    {
        $this->whitelist = $whitelist;
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $players = $this->whitelist->getList();

        return $this->response->html(
            $this->template->render('admin/whitelist/index', [
                'players' => $players
            ])
        );
    }
}