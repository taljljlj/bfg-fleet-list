<?php

namespace App\Models\FleetBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetShipArmament extends Model
{
    protected $fillable = ['ship_armament_id', 'type', 'placement', 'fire_arc', 'range_speed', 'firepower', 'misc'];

    //Relations
    public function fleetShips() {
        return $this->belongsTo(FleetShip::class);
    }
}
