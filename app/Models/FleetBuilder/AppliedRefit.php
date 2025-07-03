<?php

namespace App\Models\FleetBuilder;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AppliedRefit extends Pivot
{
    protected $table = 'applied_refits';

    public function fleetShips() {
        return $this->belongsTo(FleetShip::class);
    }
}
