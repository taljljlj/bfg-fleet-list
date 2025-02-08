<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relations
    public function armaments() {
        return $this->belongsToMany(Armament::class, 'ship_armaments')
                    ->withPivot('range_speed', 'firepower');
    }

    public function fleetLists() {
        return $this->belongsToMany(FleetList::class, 'fleetlist_ships');
    }

//      Relation removed
//    public function faction() {
//        return $this->belongsTo(Faction::class);
//    }

    //Accessors
    public function getArmourShortAttribute() {
        return str_replace('front', 'f', $this->armour);
    }
}
