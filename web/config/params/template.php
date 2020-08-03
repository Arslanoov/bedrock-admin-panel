<?php

use Framework\Template\Twig\Extension\RouteExtension;
use Framework\Template\Twig\Extension\UriEqualsExtension;
use Framework\Template\Twig\Extension\UriExtension;

return [
    'templates' => [
        'extension' => '.html.twig',
        'twig' => [
            'template_dir' => __DIR__ . '/../../templates',
            'cache_dir' => 'var/cache/twig',
            'extensions' => [
                RouteExtension::class,
                UriExtension::class,
                UriEqualsExtension::class
            ]
        ],
        'errors' => [
            400 => 'errors/400',
            403 => 'errors/403',
            404 => 'errors/404',
            500 => 'errors/500'
        ]
    ]
];