<?php

use Framework\Http\Application;
use App\Http\Action;

/** @var Application $app */

$app->get('home', '/', Action\HomeAction::class);

$app->get('users.list', '/users', Action\User\ListAction::class);

### Admin

$app->get('admin.home', '/admin', Action\Admin\HomeAction::class);

## Whitelist

$app->get('admin.whitelist.index', '/admin/whitelist', Action\Admin\Whitelist\IndexAction::class);
$app->get('admin.whitelist.add.form', '/admin/whitelist/add-player/form', Action\Admin\Whitelist\Add\FormAction::class);
$app->post('admin.whitelist.add.request', '/admin/whitelist/add-player/request', Action\Admin\Whitelist\Add\RequestAction::class);
$app->post('admin.whitelist.remove', '/admin/whitelist/remove-player/{name}', Action\Admin\Whitelist\RemoveAction::class);

