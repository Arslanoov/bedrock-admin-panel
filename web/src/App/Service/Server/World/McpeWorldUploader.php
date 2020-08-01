<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use Psr\Http\Message\UploadedFileInterface;

final class McpeWorldUploader implements WorldUploader
{
    private const WORLDS_PATH = '/app/data/worlds';

    public function upload(UploadedFileInterface $world): string
    {
        $path = self::WORLDS_PATH . '/' . $world->getClientFilename();
        $world->moveTo($path);
        return $path;
    }
}