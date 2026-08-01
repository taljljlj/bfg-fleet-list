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
    public function getArmourShortAttribute() {
        return str_replace('front', 'f', $this->armour);
    }
}
