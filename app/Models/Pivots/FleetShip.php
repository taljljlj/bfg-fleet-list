<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FleetShip extends Pivot
{
    //Relations
    public function appliedRefits() {
        return $this->belongsToMany(AppliedRefit::class, 'applied_refits', 'fleet_ship_id', 'ship_refit_id')->withTimestamps();
    }
}
