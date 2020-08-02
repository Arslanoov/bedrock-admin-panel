<?php

use Domain\Properties\Entity\FilePropertiesRepository;
use Domain\Properties\Entity\PropertiesRepository;
use Domain\Properties\Service\PropertiesEditor;
use Domain\Properties\Service\FilePropertiesEditor;
use Framework\Template\TemplateRenderer;
use Furious\Container\Container;

/** @var Container $container */

$container->set(PropertiesEditor::class, function (Container $container) {
    return new FilePropertiesEditor(
        $container->get('config')['properties']['pathToFile'],
        $container->get(TemplateRenderer::class)
    );
});

$container->set(PropertiesRepository::class, function (Container $container) {
    return new FilePropertiesRepository(
        $container->get('config')['properties']['pathToFile']
    );
});
