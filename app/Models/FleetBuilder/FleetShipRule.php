<?php

namespace App\Models\FleetBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetShipRule extends Model
{
    protected $fillable = ['text', 'text_long'];
    //Relations
    public function fleetShips() {
        return $this->belongsTo(FleetShip::class);
    }
}
