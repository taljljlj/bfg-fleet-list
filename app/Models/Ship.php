<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ship extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relations
    public function armaments() {
        return $this->belongsToMany(Armament::class, 'ship_armament')
                    ->withPivot('range_speed', 'firepower');
    }

    public function fleetLists() {
        return $this->belongsToMany(FleetList::class, 'fleetlist_ship');
    }

    public function rules() {
        return $this->belongsToMany(Rules::class, 'ship_rule', 'ship_id', 'rule_id');
    }

    public function refits() {
        return $this->belongsToMany(Refits::class, 'ship_refit', 'ship_id', 'refit_id')
            ->withPivot('points', 'firepower', 'range_speed');
    }

//      Relation removed
//    public function faction() {
//        return $this->belongsTo(Faction::class);
//    }

    //Accessors
    public function getArmourShortAttribute() {
        return str_replace('front', 'f', $this->armour);
    }

    public function getImgUrlAttribute() {
        return Str::kebab($this->class) . '.png';
    }
}
