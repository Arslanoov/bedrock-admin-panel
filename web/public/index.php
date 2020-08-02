<?php

declare(strict_types=1);

use Framework\Http\Application;
use Furious\HttpRunner\Runner;
use Psr\Http\Message\ServerRequestInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function () {
    define('ENV', 'dev');

    $container = require 'config/container.php';

    /** @var Application $app */
    $app = $container->get(Application::class);

    require 'config/pipeline.php';
    require 'config/routes.php';

    $request = $container->get(ServerRequestInterface::class);
    $response = $app->handle($request);

    $response =
        $response->withHeader('X-Developer', 'Arslanoov');

    $runner = new Runner();
    $runner->run($response);
})();