<?php

declare(strict_types=1);

namespace App\Service\Server\Properties;

use App\Service\Server\Properties\Info\Properties;

interface PropertiesService
{
    public function get(): Properties;
    public function edit(Properties $properties): void;
}