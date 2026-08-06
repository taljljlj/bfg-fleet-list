<?php

namespace App\Services;

use App\Models\FleetBuilder\FleetCommander;
use App\Models\FleetBuilder\FleetShip;
use App\Models\FleetBuilder\FleetShipRule;
use App\Models\Rules;

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
     * @param FleetCommander $fleetCommander
     * @return FleetShip|null
     */
    public function resetUnassignedShip (FleetCommander $fleetCommander) : FleetShip|null
    {
        if($fleetCommander->fleet_ship_id) {
            $fleetShip = FleetShip::findOrFail($fleetCommander->fleet_ship_id);
            $commander = $fleetCommander->commander()->first();

            switch ($commander->leadership_type) {
                case 'value':
                    $this->modifyShipAttribute($fleetShip, 'leadership', null);
                    break;

                case 'rule':
                    $rule = $commander->rule()->first();
                    FleetShipRule::where('fleet_ship_id', $fleetShip->id)
                        ->where('text', $rule->text)
                        ->where('text_long', $rule->text_long)
                        ->delete();
                    break;

                default:
                    return null;
            }
        }

        return $fleetShip ?? null;
    }
}
