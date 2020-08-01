<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use Psr\Http\Message\UploadedFileInterface;

final class McpeWorldUploader implements WorldUploader
{
    private const WORLDS_PATH = '/app/data/worlds';

    public function upload(UploadedFileInterface $world): string
    {
        $world->moveTo(self::WORLDS_PATH);
        return self::WORLDS_PATH . '/' . $world->getClientFilename();
    }
}