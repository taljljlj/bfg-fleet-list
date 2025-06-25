<?php

namespace App\Models\FleetBuilder;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FleetShip extends Pivot
{
    //Relations
    public function appliedRefits() {
        return $this->belongsToMany(AppliedRefit::class, 'applied_refits', 'fleet_ship_id', 'ship_refit_id')->withTimestamps();
    }

    public function additionalRules() {
        return $this->hasMany(FleetShipRule::class, 'fleet_ship_id');
    }

    public function armamentRefits() {
        return $this->hasMany(FleetShipArmament::class, 'fleet_ship_id');
    }

    public function getArmourShortAttribute() {
        return str_replace('front', 'f', $this->armour);
    }
}
