<?php

declare(strict_types=1);

namespace Domain\Properties\Entity;

final class Properties
{
    public MainInfo $mainInfo;
    public PortInfo $portInfo;
    public MovementInfo $movementInfo;
    public WorldInfo $worldInfo;
    public OtherInfo $otherInfo;

    /**
     * Properties constructor.
     * @param MainInfo $mainInfo
     * @param PortInfo $portInfo
     * @param MovementInfo $movementInfo
     * @param WorldInfo $worldInfo
     * @param OtherInfo $otherInfo
     */
    public function __construct(
        MainInfo $mainInfo, PortInfo $portInfo, MovementInfo $movementInfo,
        WorldInfo $worldInfo, OtherInfo $otherInfo
    )
    {
        $this->mainInfo = $mainInfo;
        $this->portInfo = $portInfo;
        $this->movementInfo = $movementInfo;
        $this->worldInfo = $worldInfo;
        $this->otherInfo = $otherInfo;
    }
}