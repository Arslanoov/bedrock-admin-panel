<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Properties;

use App\Service\Server\Properties\PropertiesService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class IndexAction implements RequestHandlerInterface
{
    private ResponseFactory $response;
    private TemplateRenderer $template;
    private PropertiesService $properties;

    /**
     * IndexAction constructor.
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     * @param PropertiesService $properties
     */
    public function __construct(ResponseFactory $response, TemplateRenderer $template, PropertiesService $properties)
    {
        $this->response = $response;
        $this->template = $template;
        $this->properties = $properties;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $properties = $this->properties->get();

        return $this->response->html(
            $this->template->render(
                'admin/properties/index', [
                    'properties' => $properties
                ]
            )
        );
    }
}