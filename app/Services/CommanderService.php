<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetBuilder\FleetCommander;

class CommanderService
{
    /**
     * Clone all fleet commanders to another fleet
     * @param Fleet $sourceFleet
     * @param Fleet $newFleet
     * @param array $clonedShipIdMap
     * @return void
     */
    public function cloneFleetCommanders(Fleet $sourceFleet, Fleet $newFleet, array $clonedShipIdMap)
    {
        $fleetCommanders = $sourceFleet->commanders()->withPivot('id','points','rolls','commander_reroll_id','fleet_ship_id')->get();
        foreach ($fleetCommanders as $commander) {
            // same as FleetShip
            // $clonedFleetCommander = $commander->pivot->replicate();
            $pivot = $commander->pivot;
            $clonedFleetCommander = new FleetCommander([
                'fleet_id' => $newFleet->id,
                'commander_id' => $pivot->commander_id,
                'points' => $pivot->points,
                'rolls' => $pivot->rolls,
                'commander_reroll_id' => $pivot->commander_reroll_id,
            ]);
            if ($pivot->fleet_ship_id) {
                $clonedFleetCommander->fleet_ship_id = $clonedShipIdMap[$pivot->fleet_ship_id];
            }
            $clonedFleetCommander->save();
        }
    }
}
