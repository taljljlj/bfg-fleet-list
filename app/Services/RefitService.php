<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\FleetList;
use App\Models\Modification;
use App\Models\FleetBuilder\FleetShip;
use App\Models\Refit;
use App\Models\Ship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class RefitService
{
    private FleetBuilderService $fleetBuilderService;

    public function __construct(FleetBuilderService $fleetBuilderService)
    {
        $this->fleetBuilderService = $fleetBuilderService;
    }

    /**
     * Due to limitations of eloquent relations rebuilding the ship's Refit relation with parent-child hierarchy
     * containing related Modifications
     *
     * @param Ship $ship
     * @return Ship
     */
    public function rebuildRefitRelation(Ship $ship) : Ship
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
    public function handleAppliedRefits(array $syncResult, FleetShip $fleetShip, Fleet $fleet): Collection
    {

        $resAttached = $this->handleAttachedRefits($syncResult['attached'], $fleetShip);
        $resDetached = $this->handleDetachedRefits($syncResult['detached'], $fleetShip);

        $pointsModifier = $resAttached['pointsModifier'] - $resDetached['pointsModifier'];
        $fleetShip->points = $this->fleetBuilderService->calculatePoints($fleetShip, $pointsModifier);
        $fleetShip->save();
        $fleet->points = $this->fleetBuilderService->calculatePoints($fleet, $pointsModifier);
        $fleet->save();

        $shipModified = ($resAttached['shipModified'] ?: $resDetached['shipModified']) ?: false;
        $armModified = ($resAttached['armModified'] ?: $resDetached['armModified']) ?: false;
        $ruleModified = ($resAttached['ruleModified'] ?: $resDetached['ruleModified']) ?: false;


        return collect(compact('shipModified', 'armModified', 'ruleModified'));
    }

    private function handleAttachedRefits(array $attachedRefits, FleetShip $fleetShip) {
        $ship = Ship::findOrFail($fleetShip->ship_id);

        $pointsModifier = $this->getRefitsPointCost($attachedRefits, $ship);
        $shipModified = $armModified = $ruleModified = false;

        foreach ($attachedRefits as $shipRefitId) {
            $modifications = $ship->modifications()
                ->wherePivot('ship_refit_id', $shipRefitId)
                ->get();

            foreach ($modifications as $modification) {
                switch ($modification->type) {
                    case 'ship':
                        $this->applyShipRefit($modification, $fleetShip);
                        $shipModified = true;
                        break;
                    case 'arm':
                        $this->applyArmamentRefit($modification, $fleetShip);
                        $armModified = true;
                        break;
                    case 'rule':
                        $this->applyRuleRefit($modification, $fleetShip);
                        $ruleModified = true;
                        break;
                    case 'group':
                        break;
                    default:
                        //TODO: handle what happens when Exception is caught and returned
                        $message = "Something went wrong. Refit type unknown, cannot process. fleet_ship_id: " . $fleetShip->id . "; ship_refit_id: " . $shipRefitId . ";";
                        Log::error($message);
                        return response()->json(['error' => $message], 500);
                }
            }
        }
        return collect(compact('pointsModifier', 'shipModified', 'armModified', 'ruleModified'));
    }

    private function handleDetachedRefits($detachedRefits, FleetShip $fleetShip) {
        $ship = Ship::findOrFail($fleetShip->ship_id);

        $pointsModifier = $this->getRefitsPointCost($detachedRefits, $ship);
        $shipModified = $armModified = $ruleModified = false;

        return collect(compact('pointsModifier', 'shipModified', 'armModified', 'ruleModified'));
    }

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
}
