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
        ]
    ]
];