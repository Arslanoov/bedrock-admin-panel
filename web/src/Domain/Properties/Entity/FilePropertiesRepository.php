<?php

declare(strict_types=1);

namespace Domain\Properties\Entity;

final class FilePropertiesRepository implements PropertiesRepository
{
    private string $propertiesPath;

    /**
     * FilePropertiesRepository constructor.
     * @param string $propertiesPath
     */
    public function __construct(string $propertiesPath)
    {
        $this->propertiesPath = $propertiesPath;
    }

    public function get(): Properties
    {
        $text = file_get_contents($this->propertiesPath);
        $info = explode("\n", $text);

        return new Properties(
            new MainInfo(
                explode('=', $info[0])[1],
                intval(explode('=', $info[16])[1]),
                trim(explode('=', $info[20])[1]) == 'true' ? true : false,
                trim(explode('=', $info[26])[1]) == 'true' ? true : false
            ),
            new PortInfo(
                intval(explode('=', $info[30])[1]),
                intval(explode('=', $info[34])[1])
            ),
            new MovementInfo(
                trim(explode('=', $info[77])[1]) == 'true' ? true : false,
                intval(explode('=', $info[82])[1]),
                floatval(explode('=', $info[86])[1]),
                intval(explode('=', $info[90])[1]),
                trim(explode('=', $info[95])[1]) == 'true' ? true : false
            ),
            new WorldInfo(
                explode('=', $info[4])[1],
                explode('=', $info[8])[1],
                trim(explode('=', $info[12])[1]) == 'true' ? true : false,
                intval(explode('=', $info[38])[1]),
                intval(explode('=', $info[42])[1]),
                explode('=', $info[57])[1],
                explode('=', $info[61])[1],
                trim(explode('=', $info[65])[1]) == 'true' ? true : false
            ),
            new OtherInfo(
                intval(explode('=', $info[50])[1]),
                intval(explode('=', $info[46])[1]),
                trim(explode('=', $info[69])[1]) == 'true' ? true : false,
                intval(explode('=', $info[73])[1])
            )
        );
    }
}