<?php

namespace App\Services;

use App\Models\FleetBuilder\FleetShip;

class ShipService
{

    /**
     * @param FleetShip $fleetShip
     * @param string $attribute
     * @param int|string|null $value
     * @return FleetShip
     */
    public function modifyShipAttribute (FleetShip $fleetShip, string $attribute, int|string|null $value): FleetShip
    {
        $fleetShip->{$attribute} = $value;
        $fleetShip->save();

        return $fleetShip;
    }

    /**
     * @param int|null $id
     * @return int|null
     */
    public function resetUnassignedShipLd (int|null $id) : int|null
    {
        if($id) {
            $unassignedFleetShip = FleetShip::findOrFail($id);
            $this->modifyShipAttribute($unassignedFleetShip, 'leadership', null);
        }

        return $unassignedFleetShip->id ?? null;
    }
}
