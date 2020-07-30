<?php

declare(strict_types=1);

namespace App\Service\Server\Properties;

final class DummyPropertiesService implements PropertiesService
{
    public function get(): array
    {
        return [
            'Some world name', '', '', '', 'survival',
            '', '', '', 'hard', '', '', '', '', '', '', '', '25'
        ];
    }
}