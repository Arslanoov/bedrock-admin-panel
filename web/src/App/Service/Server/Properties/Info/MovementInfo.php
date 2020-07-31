<?php

declare(strict_types=1);

namespace App\Service\Server\Properties\Info;

use Webmozart\Assert\Assert;

final class MovementInfo
{
    public bool $authoritativeMovement;
    public int $scoreThreshold;
    public float $distanceThreshold;
    public int $durationThreshold;
    public bool $correctPlayerMovement;

    /**
     * MovementInfo constructor.
     * @param bool $authoritativeMovement
     * @param int $scoreThreshold
     * @param float $distanceThreshold
     * @param int $durationThreshold
     * @param bool $correctPlayerMovement
     */
    public function __construct(
        bool $authoritativeMovement, int $scoreThreshold, float $distanceThreshold,
        int $durationThreshold, bool $correctPlayerMovement
    )
    {
        Assert::boolean($authoritativeMovement);
        $this->authoritativeMovement = $authoritativeMovement;
        Assert::integer($scoreThreshold);
        $this->scoreThreshold = $scoreThreshold;
        Assert::float($distanceThreshold);
        $this->distanceThreshold = $distanceThreshold;
        Assert::integer($durationThreshold);
        $this->durationThreshold = $durationThreshold;
        Assert::boolean($correctPlayerMovement);
        $this->correctPlayerMovement = $correctPlayerMovement;
    }
}