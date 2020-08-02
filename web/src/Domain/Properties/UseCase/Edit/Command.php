<?php

declare(strict_types=1);

namespace Domain\Properties\UseCase\Edit;

use Domain\Properties\Entity\MainInfo;
use Domain\Properties\Entity\MovementInfo;
use Domain\Properties\Entity\OtherInfo;
use Domain\Properties\Entity\PortInfo;
use Domain\Properties\Entity\WorldInfo;

final class Command
{
    public MainInfo $mainInfo;
    public PortInfo $portInfo;
    public MovementInfo $movementInfo;
    public WorldInfo $worldInfo;
    public OtherInfo $otherInfo;

    /**
     * Command constructor.
     * @param MainInfo $mainInfo
     * @param PortInfo $portInfo
     * @param MovementInfo $movementInfo
     * @param WorldInfo $worldInfo
     * @param OtherInfo $otherInfo
     */
    public function __construct(MainInfo $mainInfo, PortInfo $portInfo, MovementInfo $movementInfo, WorldInfo $worldInfo, OtherInfo $otherInfo)
    {
        $this->mainInfo = $mainInfo;
        $this->portInfo = $portInfo;
        $this->movementInfo = $movementInfo;
        $this->worldInfo = $worldInfo;
        $this->otherInfo = $otherInfo;
    }
}