<?php

declare(strict_types=1);

namespace Domain\Properties\Entity;

interface PropertiesRepository
{
    public function get(): Properties;
}