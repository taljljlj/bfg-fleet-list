<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetList extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relations
    public function faction() {
        return $this->belongsTo(Faction::class);
    }

    public function ships() {
        return $this->belongsToMany(Ship::class, 'fleetlist_ship');
    }
}
