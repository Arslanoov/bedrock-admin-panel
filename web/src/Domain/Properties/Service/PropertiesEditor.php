<?php

declare(strict_types=1);

namespace Domain\Properties\Service;

use Domain\Properties\Entity\Properties;

interface PropertiesEditor
{
    public function edit(Properties $properties): void;
}