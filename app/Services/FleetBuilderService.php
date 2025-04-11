<?php

namespace App\Services;

use App\Models\Faction;
use App\Models\Fleet;

class FleetBuilderService
{
    public array $shipTypeOrder = [
        'Battleship' => 1,
        'Grand Cruiser' => 2,
        'Battlecruiser' => 3,
        'Heavy Cruiser' => 3,
        'Cruiser' => 4,
        'Light Cruiser' => 5,
        'Escort' => 6,
        'Defence' => 7
    ];
    public function sortShips($ships)
    {
        $customOrder = $this->shipTypeOrder;
        return $ships->sortKeysUsing(function ($key1, $key2) use ($customOrder) {
            return $customOrder[$key1] - $customOrder[$key2];
        });
    }

    public function createFleetInitial () {
        $fleet = new Fleet();
        $fleet->name = 'Fleet #' . $fleet->id;
        $fleet->save();

        return $fleet;
    }

    public function hotpickFaction(Fleet $fleet, $factionId) {
        $fleet->faction_id = $factionId;
        $fleet->save();

        return $fleet;
    }
}
