<?php

declare(strict_types=1);

namespace Domain\Properties\Entity;

use Webmozart\Assert\Assert;

final class OtherInfo
{
    public int $maxThreads;
    public int $playerIdleTimeout;
    public bool $contentLogFile;
    public int $compression;

    /**
     * OtherInfo constructor.
     * @param int $maxThreads
     * @param int $playerIdleTimeout
     * @param bool $contentLogFile
     * @param int $compression
     */
    public function __construct(int $maxThreads, int $playerIdleTimeout, bool $contentLogFile, int $compression)
    {
        Assert::integer($maxThreads);
        Assert::greaterThan($maxThreads, 0);
        $this->maxThreads = $maxThreads;
        Assert::integer($playerIdleTimeout);
        Assert::greaterThan($playerIdleTimeout, 0);
        $this->playerIdleTimeout = $playerIdleTimeout;
        Assert::boolean($contentLogFile);
        $this->contentLogFile = $contentLogFile;
        Assert::integer($compression);
        Assert::greaterThan($compression, 0);
        Assert::lessThan($compression, 65535);
        $this->compression = $compression;
    }
}