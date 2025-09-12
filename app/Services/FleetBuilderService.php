<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetBuilder\FleetShipArmament;
use App\Models\FleetBuilder\FleetShipRule;
use App\Models\FleetList;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Ship;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class FleetBuilderService
{
    private RefitService $refitService;
    private ArmamentService $armamentService;
    private RuleService $ruleService;

    public function __construct(RefitService $refitService, ArmamentService $armamentService, RuleService $ruleService) {
        $this->refitService = $refitService;
        $this->armamentService = $armamentService;
        $this->ruleService = $ruleService;
    }
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

    /**
     * Load and prepare ship data with all necessary relations and modifications
     *
     * @param BelongsToMany $shipsRelation Base fleet relation to work with
     * @param bool $applyOrder Whether to apply ship type ordering, used to loading fleet builder page
     * @param bool $single Whether to return a single ship instance, used for applying ship refits
     * @return Collection|Ship|null
     */
    public function loadAndPrepareShips(BelongsToMany $shipsRelation, bool $applyOrder = false, bool $single = false, bool $export = false): Collection|Ship|null
    {
        $query = $shipsRelation
            ->withPivot('id', 'points', 'speed', 'turns', 'shields', 'armour', 'turrets', 'squadron_counter', 'name', 'leadership');

        $ships = $single ? $query->first() : $query->get();

        if (!$ships) {
            return null;
        }

        if ($single) {
            return $this->prepareShip($ships, $applyOrder, $export);
        }

        return $ships->map(fn($ship) => $this->prepareShip($ship, $applyOrder, $export));
    }

    /**
     * Prepare a single ship instance with all relations and modifications
     *
     * @param Ship $ship
     * @param bool $applyOrder
     * @return Ship
     */
    private function prepareShip(Ship $ship, bool $applyOrder, bool $export): Ship
    {
        if (!$export) {
            $ship = $this->refitService->rebuildRefitRelation($ship);
            $ship = $this->refitService->loadAppliedRefits($ship);
        }
        $ship = $this->armamentService->rebuildArmRelation($ship);
        $ship = $this->ruleService->rebuildRuleRelation($ship);

        if ($applyOrder) {
            $ship->order = $this->shipTypeOrder[$ship->type];
        }

        return $ship;
    }
}
