<?php

use Framework\Template\Twig\Extension\RouteExtension;

return [
    'templates' => [
        'extension' => '.html.twig',
        'twig' => [
            'template_dir' => __DIR__ . '/../../templates',
            'cache_dir' => 'var/cache/twig',
            'extensions' => [
                RouteExtension::class
            ]
        ]
    ]
];