<?php

declare(strict_types=1);

namespace App\Service\Server\Properties;

use App\Service\Server\Properties\Info\Properties;

final class DummyPropertiesService implements PropertiesService
{
    public function get(): array
    {
        return [
            'Some world name', '', '', '', 'survival',
            '', '', '', 'hard', '', '', '', '', '', '', '', '25'
        ];
    }

    public function edit(Properties $properties): void
    {
        // TODO: Implement edit() method.
    }
}