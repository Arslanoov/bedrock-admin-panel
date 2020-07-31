<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Whitelist\Add;

use App\Service\Server\Whitelist\WhitelistService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    private WhitelistService $whitelist;
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private Router $router;

    /**
     * AddAction constructor.
     * @param WhitelistService $whitelist
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param Router $router
     */
    public function __construct(WhitelistService $whitelist, ResponseFactory $response, TemplateRenderer $template, Router $router)
    {
        $this->whitelist = $whitelist;
        $this->response = $response;
        $this->template = $template;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$name = $request->getParsedBody()['name']) {
            throw new InvalidArgumentException('Empty player name.');
        }

        $this->whitelist->addPlayer($name);

        return $this->response->redirect(
            $this->router->generate('admin.whitelist.index', [])
        );
    }
}