<?php

use Framework\Http\Middleware as FrameworkMiddleware;
use App\Http\Middleware as Middleware;
use Framework\Http\Application;

/** @var Application $app */

$router = $app->getRouter();

$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe(new FrameworkMiddleware\RouteMiddleware($router));
$app->pipe(Middleware\ErrorHandler::class);
$app->pipe(FrameworkMiddleware\DispatchMiddleware::class);
