<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist;

use Domain\Whitelist\Entity\WhitelistRepository;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private WhitelistRepository $whitelist;
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * IndexAction constructor.
     * @param WhitelistRepository $whitelist
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(WhitelistRepository $whitelist, ResponseFactory $response, TemplateRenderer $template)
    {
        $this->whitelist = $whitelist;
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $whitelist = $this->whitelist->get();

        return $this->response->html(
            $this->template->render('admin/whitelist/index', [
                'whitelist' => $whitelist
            ])
        );
    }
}