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
        //Extract modification to var and unset relation
        $modifications = $ship->modifications;
        $ship->unsetRelation('modifications');


        foreach ($ship->refitParents as $refit) {
            //Find and set points pivot for children refits manually due to limitations of eloquent
            if(!empty($refit->children)) {
                foreach ($refit->children as $child) {
                    $childObj = $ship->refits->where('name', $child->name)->first();
                    $child->pivot->points = $childObj->pivot->points;
                    $childShipRefitId = $childObj->pivot->id;
                    $childRefitModifications = $this->filterModifications($modifications, $childShipRefitId);
                    $child->setRelation('modifications', $childRefitModifications);
                }
            }

            //Map modifications under their respective refits manually due to limitations of eloquent and many-to-many through relationships
            $shipRefitId = $refit->pivot->id;
            $refitModifications = $this->filterModifications($modifications, $shipRefitId);
            $refit->setRelation('modifications', $refitModifications);
        }

        return $ship;
    }

    private function filterModifications($modifications, $shipRefitId) {
        return $modifications->filter(function ($modification) use ($shipRefitId) {
            return $modification->pivot->ship_refit_id == $shipRefitId;
        });
    }
}
