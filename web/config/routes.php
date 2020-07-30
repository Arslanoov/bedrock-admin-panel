<?php

use Framework\Http\Application;
use App\Http\Action;

/** @var Application $app */

$app->get('home', '/', Action\HomeAction::class);

$app->get('users.list', '/users', Action\User\ListAction::class);
