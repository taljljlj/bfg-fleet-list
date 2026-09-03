<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetBuilder\FleetCommander;
use App\Models\FleetBuilder\FleetShip;
use App\Models\FleetBuilder\FleetShipRule;

class ShipService
{
    private RefitService $refitService;

    public function __construct(RefitService $refitService)
    {
        $this->refitService = $refitService;
    }

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

    /**
     * Clone all ships from a fleet to another fleet, return ship id map pairs [old => new]
     * @param Fleet $sourceFleet
     * @param Fleet $newFleet
     * @return array
     */
    public function cloneFleetShips(Fleet $sourceFleet, Fleet $newFleet) : array
    {
        $clonedShipIdMap = [];
        $ships = $sourceFleet->ships()->withPivot('id', 'points','speed','turns','shields','armour','turrets','squadron_counter','leadership')->get();
        foreach ($ships as $ship) {
            // not used - see FleetShip class for more info
            // $clonedFleetShip = $ship->pivot->deepClone($fleetClone->id);
            $pivot = $ship->pivot;

            $clonedFleetShip = new FleetShip([
                'fleet_id' => $newFleet->id,
                'ship_id' => $ship->id,
                'points' => $pivot->points,
                'speed' => $pivot->speed,
                'turns' => $pivot->turns,
                'shields' => $pivot->shields,
                'armour' => $pivot->armour,
                'turrets' => $pivot->turrets,
                'squadron_counter' => $pivot->squadron_counter,
                'leadership' => $pivot->leadership,
            ]);

            $clonedFleetShip->name = null;
            $clonedFleetShip->save();

            $clonedShipIdMap[$pivot->id] = $clonedFleetShip->id;

            $this->refitService->cloneShipRefitsByType($pivot, $clonedFleetShip, 'armamentRefits');
            $this->refitService->cloneShipRefitsByType($pivot, $clonedFleetShip, 'additionalRules');
            $this->refitService->cloneShipRefitsByType($pivot, $clonedFleetShip, 'appliedRefitsDirect');

        }

        return $clonedShipIdMap;
    }
}
