<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Properties\Edit;

use App\Service\Server\Properties\PropertiesService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class FormAction implements RequestHandlerInterface
{
    private PropertiesService $properties;
    private ResponseFactory $response;
    private TemplateRenderer $template;

    /**
     * FormAction constructor.
     * @param PropertiesService $properties
     * @param ResponseFactory $response
     * @param TemplateRenderer $template
     */
    public function __construct(PropertiesService $properties, ResponseFactory $response, TemplateRenderer $template)
    {
        $this->properties = $properties;
        $this->response = $response;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $properties = $this->properties->get();

        return $this->response->html(
            $this->template->render('admin/properties/edit/form', [
                'properties' => $properties
            ])
        );
    }
}