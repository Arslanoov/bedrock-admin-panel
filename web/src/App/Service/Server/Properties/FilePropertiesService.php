<?php

declare(strict_types=1);

namespace App\Service\Server\Properties;

final class FilePropertiesService implements PropertiesService
{
    public function get(): array
    {
        $text = file_get_contents('/opt/mcpe-data/server.properties');
        $info = explode("\n", $text);

        $pieces = [];
        foreach ($info as $infoPiece) {
            $pieces[] = explode("=", $infoPiece)[1];
        }

        return $pieces;
    }
}