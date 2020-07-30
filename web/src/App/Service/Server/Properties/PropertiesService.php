<?php

declare(strict_types=1);

namespace App\Service\Server\Properties;

interface PropertiesService
{
    public function get(): array;
}