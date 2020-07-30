<?php

declare(strict_types=1);

namespace App\Http\Action\User;

use Domain\User\Entity\UserRepository;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ListAction implements RequestHandlerInterface
{
    private UserRepository $users;
    private TemplateRenderer $template;
    private ResponseFactory $response;

    /**
     * ListAction constructor.
     * @param UserRepository $users
     * @param TemplateRenderer $template
     * @param ResponseFactory $response
     */
    public function __construct(UserRepository $users, TemplateRenderer $template, ResponseFactory $response)
    {
        $this->users = $users;
        $this->template = $template;
        $this->response = $response;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $users = $this->users->findAll();

        return $this->response->html(
            $this->template->render('users/list', [
                'users' => $users
            ])
        );
    }
}