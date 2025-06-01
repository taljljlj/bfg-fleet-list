<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\Ship;
use Illuminate\Support\Collection;

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

    private function sortShips($ships)
    {
        $customOrder = $this->shipTypeOrder;
        return $ships->sortKeysUsing(function ($key1, $key2) use ($customOrder) {
            return $customOrder[$key1] - $customOrder[$key2];
        });
    }

    public function createFleetInitial()
    {
        $fleet = new Fleet();
        $fleet->name = 'Fleet #' . $fleet->id;
        $fleet->save();

        return $fleet;
    }

    public function hotpickFaction(Fleet $fleet, $factionId)
    {
        $fleet->faction_id = $factionId;
        $fleet->save();

        return $fleet;
    }

    public function getShipsByFleetList(FleetList $fleetList)
    {
        $ships = $fleetList->getShipsGroupedByType();

        return $this->sortShips($ships);
    }

    public function calculateFleetPoints(Fleet $fleet, int $pointModifier)
    {
        return ($fleet->points + $pointModifier);
    }

    /**
     * @param Ship $ship
     * @return Ship
     */
    public function handleShipRefits(Ship $ship) : Ship
    {
        $distinctRefits = collect();
        $processedNames = [];

        foreach ($ship->refits as $refit) {
            if (!in_array($refit->name, $processedNames)) {
                $distinctRefits->push($refit);
                $processedNames[] = $refit->name;
            }
        }

        foreach ($ship->refits as $refit) {
            if ($refit->type == 'group') {
                $childrenNames = json_decode($refit->value, false);
                $refitChildren = $ship->refits->whereIn('name', $childrenNames);

                $parentRefit = $distinctRefits->where('name', $refit->name)->first();
                $parentRefit->setRelation('children', $refitChildren);

                $distinctRefits = $distinctRefits->reject(fn($item) => in_array($item->name, $childrenNames));
            }
        }
        $ship->unsetRelation('refits');
        $ship->setRelation('refits', $distinctRefits);

        return $ship;
    }
}
