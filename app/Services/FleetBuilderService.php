<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetBuilder\FleetCommander;
use App\Models\FleetBuilder\FleetShipArmament;
use App\Models\FleetBuilder\FleetShipRule;
use App\Models\FleetList;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Ship;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

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
        $fleet->save();

        if (auth()->check()) {
            $fleet->user_id = auth()->id();
        } else {
            session()->push('guestFleetIds', $fleet->id);
        }
        $fleet->name = $fleet->default_name;
        $fleet->save();

        return $fleet;
    }

    public function hotpickFaction(Fleet $fleet, $factionId)
    {
        $fleet->faction_id = $factionId;
        $fleet->save();

        return $fleet;
    }

    /**
     * @param FleetList $fleetList
     * @return Collection
     */
    public function getShipsByFleetList(FleetList $fleetList) : Collection
    {
        $ships = $fleetList->getShipsGroupedByType();

        return $this->sortShips($ships);
    }

    /**
     * @param FleetList $fleetList
     * @return Collection
     */
    public function getCommandersByFleetList(FleetList $fleetList) : Collection
    {
        return $fleetList->commanders()->get();
    }

    /**
     * Load and prepare ship data with all necessary relations and modifications
     *
     * @param BelongsToMany $shipsRelation Base fleet relation to work with
     * @param bool $applyOrder Whether to apply ship type ordering, used to loading fleet builder page
     * @param bool $single Whether to return a single ship instance, used for applying ship refits
     * @param bool $export
     * @return Collection|Ship|null
     */
    public function loadAndPrepareShips(BelongsToMany $shipsRelation, bool $applyOrder = false, bool $single = false, bool $readonly= false): Collection|Ship|null
    {
        $query = $shipsRelation
            ->withPivot('id', 'points', 'speed', 'turns', 'shields', 'armour', 'turrets', 'squadron_counter', 'name', 'leadership');

        $ships = $single ? $query->first() : $query->get();

        if (!$ships) {
            return null;
        }

        if ($single) {
            return $this->prepareShip($ships, $applyOrder, $readonly);
        }

        return $ships->map(fn($ship) => $this->prepareShip($ship, $applyOrder, $readonly));
    }

    /**
     * Prepare a single ship instance with all relations and modifications
     *
     * @param Ship $ship
     * @param bool $applyOrder
     * @param bool $export
     * @return Ship
     */
    private function prepareShip(Ship $ship, bool $applyOrder, bool $readonly): Ship
    {
        if (!$readonly) {
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

    /**
     * Soft-delete fleet. Detach it from user and reset fleet and ship names to defaults, but keep the fleet record.
     * @param Fleet $fleet
     * @return void
     */
    public function deleteFleet(Fleet $fleet) : void
    {
        $fleet->user_id = null;
        $fleet->name = $fleet->default_name;
        $fleet->save();

        FleetShip::where('fleet_id', $fleet->id)
            ->whereNotNull('name')
            ->update(['name' => null]);

        if(!auth()->check()) {
            $guestFleetIds = session('guestFleetIds', []);
            $guestFleetIds = array_filter($guestFleetIds, fn($id) => $id !== $fleet->id);
            session()->put('guestFleetIds', $guestFleetIds);
        }
    }

    /**
     * Clone fleet and all its related objects and assign to the current user or guest session
     * @param Fleet $fleet
     * @return Fleet
     */
    public function cloneFleet(Fleet $fleet) : Fleet
    {
        $fleetClone = $fleet->replicate();
        $fleetClone->notes = null;
        $fleetClone->save();

        if (auth()->check()) {
            $fleetClone->user_id = auth()->id();
        } else {
            session()->push('guestFleetIds', $fleetClone->id);
        }
        $fleetClone->name = $fleetClone->default_name;
        $fleetClone->save();

        $clonedShipIdMap = [];
        $fleetShips = $fleet->ships()->withPivot('id', 'points','speed','turns','shields','armour','turrets','squadron_counter','leadership')->get();
        foreach ($fleetShips as $ship) {
        // not used - see FleetShip class for more info
        // $clonedFleetShip = $ship->pivot->deepClone($fleetClone->id);
            $pivot = $ship->pivot;

            $clonedFleetShip = new FleetShip([
                'fleet_id' => $fleetClone->id,
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

            //TODO: handle armaments, rules and applied refits
        }

        $fleetCommanders = $fleet->commanders()->withPivot('id','points','rolls','commander_reroll_id','fleet_ship_id')->get();
        foreach ($fleetCommanders as $commander) {
        // same as FleetShip
        // $clonedFleetCommander = $commander->pivot->replicate();
            $pivot = $commander->pivot;
            $clonedFleetCommander = new FleetCommander([
                'fleet_id' => $fleetClone->id,
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

        return $fleetClone;
    }
}
