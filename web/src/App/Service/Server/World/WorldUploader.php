<?php

declare(strict_types=1);

namespace App\Service\Server\World;

use Psr\Http\Message\UploadedFileInterface;

interface WorldUploader
{
    public function upload(UploadedFileInterface $world): string;
}