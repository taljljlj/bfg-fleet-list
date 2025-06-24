<?php

namespace App\Services;

use App\Models\Armament;
use App\Models\FleetBuilder\FleetShipArmament;
use App\Models\Ship;
use Illuminate\Support\Collection;


class ArmamentService
{
    public function rebuildArmRelation(Ship $ship) : Ship
    {
        $refittedArms = FleetShipArmament::where('fleet_ship_id', $ship->pivot->id)->get();

        $shipArms = $ship->armaments;
        $ship->unsetRelation('armaments');

        foreach ($refittedArms as $refittedArm){
            //If refit removes armament
            if($refittedArm->ship_armament_id && $refittedArm->type === '_removed'){
                $shipArms = $this->removeArmament($shipArms, $refittedArm->ship_armament_id);
            }
            //If refit modifies or replaces the armament
            elseif($refittedArm->ship_armament_id && $refittedArm->type != '_removed'){
                $shipArms = $this->overrideArmWithRefit($shipArms, $refittedArm);
            }
            //If refit adds armament
            elseIf(!$refittedArm->ship_armament_id){
                $armament = $this->constructArmObjFromRefit($refittedArm);
                $shipArms->push($armament);
            }
        }

        $ship->setRelation('armaments', $shipArms);

        return $ship;
    }

    private function removeArmament(Collection $shipArms, int $shipArmId) : Collection
    {
        return $shipArms->reject(function ($item) use ($shipArmId) {
            return $item->pivot->id == $shipArmId;
        });

    }

    private function overrideArmWithRefit(Collection $armaments, FleetShipArmament $refittedArm) : Collection
    {
        return $armaments->transform(function ($item) use ($refittedArm) {
            if (isset($item->pivot->id) && $item->pivot->id == $refittedArm->ship_armament_id) {
                $item->type = $refittedArm->type;
                $item->placement = $refittedArm->placement;
                $item->fire_arc = $refittedArm->fire_arc;

                $item->pivot->range_speed = $refittedArm->range_speed;
                $item->pivot->firepower = $refittedArm->firepower;
                $item->pivot->misc = $refittedArm->misc;
            }

            return $item;
        });
    }

    private function constructArmObjFromRefit(FleetShipArmament $refittedArm) : Armament
    {
        $armament = new Armament();
        $armament->type = $refittedArm->type;
        $armament->placement = $refittedArm->placement;
        $armament->fire_arc = $refittedArm->fire_arc;

        $armament->setRelation('pivot', (object)[
            'range_speed' => $refittedArm->range_speed,
            'firepower' => $refittedArm->firepower,
            'misc' => $refittedArm->misc,
        ]);

        return $armament;
    }
}
