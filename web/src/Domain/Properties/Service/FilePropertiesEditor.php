<?php

declare(strict_types=1);

namespace Domain\Properties\Service;

use Domain\Properties\Entity\Properties;
use Framework\Template\TemplateRenderer;

final class FilePropertiesEditor implements PropertiesEditor
{
    private string $propertiesPath;
    private TemplateRenderer $template;

    /**
     * FilePropertiesEditor constructor.
     * @param string $propertiesPath
     * @param TemplateRenderer $template
     */
    public function __construct(string $propertiesPath, TemplateRenderer $template)
    {
        $this->propertiesPath = $propertiesPath;
        $this->template = $template;
    }

    public function edit(Properties $properties): void
    {
        file_put_contents(
            $this->propertiesPath,
            $this->template->render('admin/properties/list', [
                'properties' => $properties
            ])
        );
    }
}