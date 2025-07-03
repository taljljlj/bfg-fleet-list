<?php

namespace App\Models\FleetBuilder;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FleetShip extends Pivot
{
    protected static function booted() {
        // Cascade delete related objects
        static::deleting(function ($fleetShip) {
            $fleetShip->armamentRefits()->delete();
            $fleetShip->additionalRules()->delete();
            $fleetShip->appliedRefits()->detach();
        });

    }

    //Relations
    public function appliedRefits() {
        return $this->belongsToMany(AppliedRefit::class, 'applied_refits', 'fleet_ship_id', 'ship_refit_id')->withTimestamps();
    }

    public function additionalRules() {
        return $this->hasMany(FleetShipRule::class, 'fleet_ship_id');
    }

    public function armamentRefits() {
        return $this->hasMany(FleetShipArmament::class, 'fleet_ship_id');
    }

    public function ships() {
        return $this->hasOne(Ship::class, 'id', 'ship_id');
    }

    //Accessors
    public function getArmourShortAttribute() {
        return str_replace('front', 'f', $this->armour);
    }

    public function getSquadronPointsAttribute() {
        if ($this->squadron_counter) {
            return $this->points * $this->squadron_counter;
        } else {
            return null;
        }
    }

    public function getLeadershipAttribute() {
        if ($this->ships()->first()->type === 'Escort') {
            return implode('-' ,str_split($this->attributes['leadership']));
        } else {
            return $this->attributes['leadership'];
        }
    }

    //Mutators
    public function setLeadershipAttribute($value)
    {
        if ($this->ships()->first()->type === 'Escort') {
            $this->attributes['leadership'] = preg_replace('/\D/', '', $value);
        } else {
            $this->attributes['leadership'] = $value;
        }
    }
}
