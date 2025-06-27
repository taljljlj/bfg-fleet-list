<?php

namespace App\Helpers;

use App\Models\Fleet;
use App\Models\FleetBuilder\FleetShip;

class FleetBuilderUtils
{
    /**
     * @param FleetShip|Fleet $object
     * @param int $pointModifier
     * @return int|mixed
     */
    public static function calculatePoints(FleetShip|Fleet $object, int $pointModifier)
    {
        return ($object->points + $pointModifier);
    }
}
