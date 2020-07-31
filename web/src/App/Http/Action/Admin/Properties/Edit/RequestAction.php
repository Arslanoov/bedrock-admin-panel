<?php

declare(strict_types=1);

namespace App\Http\Action\Admin\Properties\Edit;

use App\Service\Server\Properties\Info\MainInfo;
use App\Service\Server\Properties\Info\MovementInfo;
use App\Service\Server\Properties\Info\OtherInfo;
use App\Service\Server\Properties\Info\PortInfo;
use App\Service\Server\Properties\Info\Properties;
use App\Service\Server\Properties\Info\WorldInfo;
use App\Service\Server\Properties\PropertiesService;
use Framework\Http\Psr7\ResponseFactory;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    private PropertiesService $properties;
    private ResponseFactory $response;
    private Router $router;

    /**
     * RequestAction constructor.
     * @param PropertiesService $properties
     * @param ResponseFactory $response
     * @param Router $router
     */
    public function __construct(PropertiesService $properties, ResponseFactory $response, Router $router)
    {
        $this->properties = $properties;
        $this->response = $response;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $this->properties->edit(
            new Properties(
                new MainInfo(
                    $body['server_name'] ?? '',
                    intval($body['max_players'] ?? ''),
                    $body['online_mode'] == 'true' ? true : false,
                    $body['whitelist'] == 'true' ? true : false
                ),
                new PortInfo(
                    intval($body['server_port'] ?? ''),
                    intval($body['server_ipv6_port'] ?? '')
                ),
                new MovementInfo(
                    $body['auth_movement'] == 'true' ? true : false,
                    intval($body['score_threshold']),
                    floatval($body['distance_threshold']),
                    intval($body['duration_threshold']),
                    $body['correct_player_movement'] == 'true' ? true : false
                ),
                new WorldInfo(
                    $body['gamemode'] ?? '',
                    $body['difficulty'] ?? '',
                    $body['allow_cheats'] == 'true' ? true : false,
                    intval($body['view_distance'] ?? ''),
                    intval($body['tick_distance'] ?? ''),
                    $body['world_seed'] ?? '',
                    $body['default_player_permission'] ?? '',
                    $body['texture_pack_required'] == 'true' ? true : false
                ),
                new OtherInfo(
                    intval($body['max_threads'] ?? ''),
                    intval($body['player_idle_timeout'] ?? ''),
                    $body['content_log_file'] == 'true' ? true : false,
                    intval($body['compression'] ?? '')
                )
            )
        );

        return $this->response->redirect(
            $this->router->generate('admin.properties.index', [])
        );
    }
}