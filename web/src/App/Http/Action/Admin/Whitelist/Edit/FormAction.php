<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist\Edit;

use Domain\Whitelist\Entity\WhitelistRepository;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class FormAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private WhitelistRepository $whitelist;

    /**
     * FormAction constructor.
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param WhitelistRepository $whitelist
     */
    public function __construct(ResponseFactory $response, TemplateRenderer $template, WhitelistRepository $whitelist)
    {
        $this->response = $response;
        $this->template = $template;
        $this->whitelist = $whitelist;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $uuid = $request->getAttribute('uuid');
        $player = $this->whitelist->getByUuid($uuid);

        return $this->response->html(
            $this->template->render('admin/whitelist/edit/form', [
                'player' => $player
            ])
        );
    }
}