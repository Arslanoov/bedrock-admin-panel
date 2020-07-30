<?php

declare(strict_types=1);

namespace App\Http\Action\Admin;

use App\Service\Server\Properties\PropertiesService;
use App\Service\Server\Whitelist\WhitelistService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomeAction implements RequestHandlerInterface
{
    private WhitelistService $whitelist;
    private PropertiesService $properties;
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * HomeAction constructor.
     * @param WhitelistService $whitelist
     * @param PropertiesService $properties
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(WhitelistService $whitelist, PropertiesService $properties, ResponseFactory $response, TemplateRenderer $template)
    {
        $this->whitelist = $whitelist;
        $this->properties = $properties;
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $whitelistPlayers = $this->whitelist->getList();
        $properties = $this->properties->get();

        return $this->response->html(
            $this->template->render('admin/home', [
                'players' => $whitelistPlayers,
                'properties' => $properties
            ])
        );
    }
}