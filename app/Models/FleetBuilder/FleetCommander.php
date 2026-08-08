<?php

namespace App\Models\FleetBuilder;

use App\Models\Commander;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FleetCommander extends Pivot
{

    //Relations
    public function commander() {
        return $this->hasOne(Commander::class, 'id', 'commander_id');
    }

    //Accessors
    public function getCommanderRerollIdAttribute($value)
    {
        return $value ?? 0;
    }

}
