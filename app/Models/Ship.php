<?php

namespace App\Models;

use App\Models\FleetBuilder\FleetShip;
use App\Models\FleetBuilder\ShipModification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ship extends Model
{
    public $timestamps = false;

    protected $appends = ['armour_short', 'img_url'];

    //Relations
    public function armaments() {
        return $this->belongsToMany(Armament::class, 'ship_armament')
                    ->withPivot('id', 'range_speed', 'firepower', 'misc');
    }

    public function fleetLists() {
        return $this->belongsToMany(FleetList::class, 'fleet_list_ship');
    }

    public function rules() {
        return $this->belongsToMany(Rules::class, 'ship_rule', 'ship_id', 'rule_id');
    }

    public function modifications() {
        return $this->belongsToMany(Modification::class, 'ship_modification')
            ->withPivot('ship_refit_id', 'firepower', 'range_speed', 'misc');
    }

    public function refits() {
        return $this->belongsToMany(Refit::class, 'ship_refit', 'ship_id', 'refit_id')
            ->with('children')
            ->withPivot('id', 'points');
    }
    public function fleets() {
        return $this->belongsToMany(Fleet::class, 'fleet_ship')->using(FleetShip::class)->withTimestamps();
    }

    public function factions() {
        return $this->belongsTo(Faction::class);
    }

    //Accessors
    public function getArmourShortAttribute() {
        return str_replace(
            ['front', 'sides', 'rear'],
            ['f', 's', 'r'],
            $this->armour
        );
    }

    public function getImgUrlAttribute() {
        return Str::kebab($this->class) . '.png';
    }
}
