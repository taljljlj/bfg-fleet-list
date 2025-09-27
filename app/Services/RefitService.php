<?php

namespace App\Services;

use App\Helpers\FleetBuilderUtils;
use App\Models\Fleet;
use App\Models\FleetBuilder\AppliedRefit;
use App\Models\FleetList;
use App\Models\Modification;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Refit;
use App\Models\Ship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class RefitService
{
    /**
     * Due to limitations of eloquent relations rebuilding the ship's Refit relation with parent-child hierarchy
     * containing related Modifications
     *
     * @param Ship $ship
     * @return Ship
     */
    public function rebuildRefitRelation(Ship $ship) : Ship
    {
        //Get default refits/modifications
        $refits = $ship->refits()->get();
        $modifications = $ship->modifications()->get();

        foreach ($refits as $refit) {
            //Find and set pivot for children refits manually due to limitations of eloquent
            if(!empty($refit->children)) {
                foreach ($refit->children as $child) {
                    $childFromShipRefits = $refits->where('id', $child->id)->first();
                    $refits = $refits->reject(function ($refit) use ($childFromShipRefits) {
                        return $childFromShipRefits->id === $refit->id;
                    });


                    $child->setRelation('pivot', $childFromShipRefits->pivot);


                    $childRefitModifications = $this->filterModifications($modifications, $child->pivot->id);
                    $child->setRelation('modifications', $childRefitModifications);
                }
            }

            //Map modifications under their respective refits manually due to limitations of eloquent and many-to-many through relationships
            $shipRefitId = $refit->pivot->id;
            $refitModifications = $this->filterModifications($modifications, $shipRefitId);
            $refit->setRelation('modifications', $refitModifications);
        }

        $ship->setRelation('refits', $refits->values());


        return $ship;
    }

    /**
     * Filter collection of Modification objects by ship_refit_id
     *
     * @param Collection $modifications
     * @param int $shipRefitId
     * @return Collection
     */
    private function filterModifications(Collection $modifications, int $shipRefitId) {
        return $modifications->filter(function ($modification) use ($shipRefitId) {
            return $modification->pivot->ship_refit_id == $shipRefitId;
        });
    }

    /**
     * Process refits applied to ship, apply their modifiers and update points
     *
     * @param array $syncResult
     * @param FleetShip $fleetShip
     * @param Fleet $fleet
     * @return Collection
     */
    public function handleAppliedRefits(array $syncResult, FleetShip $fleetShip, Fleet $fleet): void
    {

        $attachedPointsModifier = $this->handleAttachedRefits($syncResult['attached'], $fleetShip);
        $detachedPointsModifier = $this->handleDetachedRefits($syncResult['detached'], $fleetShip);

        $pointsModifier = $attachedPointsModifier - $detachedPointsModifier;
        $fleetShip->points = FleetBuilderUtils::calculatePoints($fleetShip, $pointsModifier);
        $fleetShip->save();
        $fleet->points = FleetBuilderUtils::calculatePoints($fleet, $pointsModifier);
        $fleet->save();
    }

    /**
     * Process attached refits that are applied to ship, store data in fleet_ship tables
     *
     * @param array $attachedRefits ship_refit_id array
     * @param FleetShip $fleetShip
     * @return int
     */
    private function handleAttachedRefits(array $attachedRefits, FleetShip $fleetShip): int
    {
        $ship = Ship::findOrFail($fleetShip->ship_id);

        $pointsModifier = $this->getRefitsPointCost($attachedRefits, $ship);

        foreach ($attachedRefits as $shipRefitId) {
            $modifications = $ship->modifications()
                ->wherePivot('ship_refit_id', $shipRefitId)
                ->get();

            foreach ($modifications as $modification) {
                switch ($modification->type) {
                    case 'ship':
                        $this->applyShipRefit($modification, $fleetShip);
                        break;
                    case 'arm':
                        $this->applyArmamentRefit($modification, $fleetShip);
                        break;
                    case 'rule':
                        $this->applyRuleRefit($modification, $fleetShip);
                        break;
                    case 'group':
                        //TODO: handle group refit
                        break;
                    default:
                        //TODO: handle what happens when Exception is caught and returned. Extract this to callable function because of duplication
                        $message = "Something went wrong. Refit type unknown, cannot process. fleet_ship_id: " . $fleetShip->id . "; ship_refit_id: " . $shipRefitId . ";";
                        Log::error($message);
//                        return response()->json(['error' => $message], 500);
                }
            }
        }
        return $pointsModifier;
    }

    /**
     *  Process detached refits that are applied to ship, drop data from fleet_ship tables
     *
     * @param array $detachedRefits ship_refit_id array
     * @param FleetShip $fleetShip
     * @return int
     */
    private function handleDetachedRefits(array $detachedRefits, FleetShip $fleetShip): int
    {
        $ship = Ship::findOrFail($fleetShip->ship_id);

        $pointsModifier = $this->getRefitsPointCost($detachedRefits, $ship);

        foreach ($detachedRefits as $shipRefitId) {
            $modifications = $ship->modifications()
                ->wherePivot('ship_refit_id', $shipRefitId)
                ->get();

            foreach ($modifications as $modification) {
                switch ($modification->type) {
                    case 'ship':
                        $this->removeShipRefit($modification, $fleetShip, $ship);
                        break;
                    case 'arm':
                        $this->removeArmRefit($modification, $fleetShip);
                        break;
                    case 'rule':
                        $this->removeRuleRefit($modification, $fleetShip);
                        break;
                }
            }
        }

        return $pointsModifier;
    }

    /**
     * Get the total sum of point cost of refits applied
     *
     * @param array $refitIds
     * @param Ship $ship
     * @return int
     */
    private function getRefitsPointCost(array $refitIds, Ship $ship) {
        $pointsModifier = 0;

        foreach ($refitIds as $shipRefitId) {
            $refitPoints = $ship->refits()->newPivotStatement()
                ->select('points')
                ->where('id', $shipRefitId)
                ->first()
                ->points;

            $pointsModifier = $pointsModifier + $refitPoints;
        }

        return $pointsModifier;
    }

    /**
     * Create and store refit that overrides ship's default stats
     *
     * @param Modification $modification
     * @param FleetShip $fleetShip
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function applyShipRefit(Modification $modification, FleetShip $fleetShip) {
        switch ($modification->action) {
            case 'modify':
                $fleetShip->{$modification->module} = $modification->pivot->firepower ?: $modification->pivot->misc;
                $fleetShip->save();
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Create and store refit that overrides/extends ship's default armaments
     *
     * @param Modification $modification
     * @param FleetShip $fleetShip
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function applyArmamentRefit(Modification $modification, FleetShip $fleetShip) {
        switch ($modification->action) {
            case 'add':
                $resultArmData = json_decode($modification->value, true);

                $fleetShip->armamentRefits()->create([
                    'type' => $resultArmData['type'],
                    'placement' => $resultArmData['placement'],
                    'fire_arc' => $resultArmData['fire_arc'],
                    'range_speed' => $modification->pivot->range_speed,
                    'firepower' => $modification->pivot->firepower,
                    'misc' => $modification->pivot->misc,
                ]);
                break;
            case 'remove':
                $targetArmData = json_decode($modification->module, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()->create([
                        'ship_armament_id' => $targetArm->pivot->id,
                        'type' => '_removed',
                    ]);
                }
                break;
            case 'modify':
                $targetArmData = json_decode($modification->module, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()->create([
                        'ship_armament_id' => $targetArm->pivot->id,
                        'type' => $targetArm->type,
                        'placement' => $targetArm->placement,
                        'fire_arc' => $targetArm->fire_arc,
                        'range_speed' => $modification->pivot->range_speed ?: $targetArm->pivot->range_speed,
                        'firepower' => $modification->pivot->firepower ?: $targetArm->pivot->firepower,
                        'misc' => $modification->pivot->misc ?: $targetArm->pivot->misc
                    ]);
                }
                break;
            case 'replace':
                $targetArmData = json_decode($modification->module, true);
                $resultArmData = json_decode($modification->value, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()->create([
                        'ship_armament_id' => $targetArm->pivot->id,
                        'type' => $resultArmData['type'],
                        'placement' => $resultArmData['placement'],
                        'fire_arc' => $resultArmData['fire_arc'],
                        'range_speed' => $modification->pivot->range_speed,
                        'firepower' => $modification->pivot->firepower,
                        'misc' => $modification->pivot->misc
                    ]);
                }
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Get default ship armaments based on refit data
     *
     * @param FleetShip $fleetShip
     * @param array $targetArmData
     * @return mixed
     */
    private function getTargetArmaments(FleetShip $fleetShip, array $targetArmData) {
        $ship = Ship::findOrFail($fleetShip->ship_id);
        $targetArmsQuery = $ship->armaments()->where('type', $targetArmData['type']);
        if ($targetArmData['placement']) {
            $targetArmsQuery = $targetArmsQuery->where('placement', $targetArmData['placement']);
        }
        if ($targetArmData['fire_arc']) {
            $targetArmsQuery= $targetArmsQuery->where('fire_arc', $targetArmData['fire_arc']);
        }
        return $targetArmsQuery->get();
    }

    /**
     * Create and store refit that extends ship's default rules
     *
     * @param Modification $modification
     * @param FleetShip $fleetShip
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function applyRuleRefit(Modification $modification, FleetShip $fleetShip) {
        switch ($modification->action) {
            case 'add':
                $refit = Refit::findOrFail($modification->refit_id);

                $fleetShip->additionalRules()->create([
                    'text' => $modification->value,
                    'text_long' => $refit->text_long,
                    ]);
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Remove refit that overrides ship's default stats
     *
     * @param FleetShip $fleetShip
     * @param Modification $modification
     * @param Ship $ship
     * @return void
     */
    private function removeShipRefit(Modification $modification, FleetShip $fleetShip, Ship $ship): void
    {
        switch ($modification->action) {
            case 'modify':
                $fleetShip->{$modification->module} = $ship->{$modification->module};
                $fleetShip->save();
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                response()->json(['error' => $message], 500);
        }
    }

    /**
     * Remove refit that overrides/extends ship's default armaments
     *
     * @param FleetShip $fleetShip
     * @param Modification $modification
     * @param Ship $ship
     * @return void
     */
    private function removeArmRefit(Modification $modification, FleetShip $fleetShip): void
    {
        switch ($modification->action) {
            case 'add':
                $resultArmData = json_decode($modification->value, true);

                $fleetShip->armamentRefits()
                    ->whereNull('ship_armament_id')
                    ->where([
                        'type' => $resultArmData['type'],
                        'placement' => $resultArmData['placement'],
                    ])
                    ->delete();
                break;
            case 'remove':
                $targetArmData = json_decode($modification->module, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()
                        ->where([
                            'ship_armament_id' => $targetArm->pivot->id,
                            'type' => '_removed',
                        ])
                        ->delete();
                }
                break;
            case 'modify':
                $targetArmData = json_decode($modification->module, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()
                        ->where([
                            'ship_armament_id' => $targetArm->pivot->id,
                            'type' => $targetArm->type,
                            'placement' => $targetArm->placement,
                        ])
                        ->delete();
                }
                break;
            case 'replace':
                $targetArmData = json_decode($modification->module, true);
                $resultArmData = json_decode($modification->value, true);
                $targetArms = $this->getTargetArmaments($fleetShip, $targetArmData);

                foreach ($targetArms as $targetArm) {
                    $fleetShip->armamentRefits()
                        ->where([
                            'ship_armament_id' => $targetArm->pivot->id,
                            'type' => $resultArmData['type'],
                            'placement' => $resultArmData['placement'],
                        ])
                        ->delete();
                }
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                response()->json(['error' => $message], 500);
        }
    }

    /**
     * Remove refit that extends ship's default rules
     *
     * @param Modification $modification
     * @param FleetShip $fleetShip
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function removeRuleRefit(Modification $modification, FleetShip $fleetShip) {
        switch ($modification->action) {
            case 'add':
                $refit = Refit::findOrFail($modification->refit_id);

                $fleetShip->additionalRules()
                    ->where([
                        'text' => $modification->value,
                        'text_long' => $refit->text_long,
                    ])
                    ->delete();
                break;
            default:
                $message = "Something went wrong. Refit cannot be applied, unknown refit action. fleet_ship_id: " . $fleetShip->id . "; modification_id: " . $modification->id . ";";
                Log::error($message);
                return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Fetch applied refits based on fleet_ship_id and set it as relation for Ship object
     *
     * @param Ship $ship
     * @return Ship
     */
    public function loadAppliedRefits(Ship $ship): Ship
        // TODO: eager loading doesn't seem possible without making it more complex than raw query below
        //  - However creating a custom ShipCollection class might be worth looking into
    {
        $appliedRefits = AppliedRefit::where('fleet_ship_id', $ship->pivot->id)->get();
        $ship->setRelation('appliedRefits', $appliedRefits);

        return $ship;
    }
}
