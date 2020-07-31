<?php

declare(strict_types=1);

namespace App\Service\Server\Properties\Info;

use Webmozart\Assert\Assert;

final class PortInfo
{
    public int $serverPort;
    public int $serverIpv6Port;

    /**
     * PortInfo constructor.
     * @param int $serverPort
     * @param int $serverIpv6Port
     */
    public function __construct(int $serverPort, int $serverIpv6Port)
    {
        Assert::integer($serverPort);
        Assert::greaterThan($serverPort, 0);
        Assert::lessThan($serverPort, 65535);
        $this->serverPort = $serverPort;

        Assert::integer($serverIpv6Port);
        Assert::greaterThan($serverIpv6Port, 0);
        Assert::lessThan($serverIpv6Port, 65535);
        $this->serverIpv6Port = $serverIpv6Port;
    }
}