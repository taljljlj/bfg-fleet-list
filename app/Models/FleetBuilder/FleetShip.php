<?php

namespace App\Models\FleetBuilder;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FleetShip extends Pivot
{
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'fleet_ship';

    protected static function booted() {
        // Cascade delete related objects
        static::deleting(function ($fleetShip) {
            $fleetShip->armamentRefits()->delete();
            $fleetShip->additionalRules()->delete();
            $fleetShip->appliedRefits()->detach();
        });

    }

    //Relations

    /**
     * This relation connects to the ship_refit pivot table. belongsToMany works fine with attach/detach eloquent methods
     * Not to be used to access applied_refits directly, breaks with self-referencing join. Use appliedRefitsDirect instead
     */
    public function appliedRefits() {
        return $this->belongsToMany(AppliedRefit::class, 'applied_refits', 'fleet_ship_id', 'ship_refit_id')->withTimestamps();
    }

    public function additionalRules() {
        return $this->hasMany(FleetShipRule::class, 'fleet_ship_id');
    }


    public function armamentRefits() {
        return $this->hasMany(FleetShipArmament::class, 'fleet_ship_id');
    }

    /**
     * Alternative to appliedRefits relation for direct access to applied_refits table.
     */
    public function appliedRefitsDirect() {
        return $this->hasMany(AppliedRefit::class, 'fleet_ship_id');
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
        if (strlen($this->attributes['leadership']) >= 2 && $this->attributes['squadron_counter']) {
            return implode('-' ,str_split($this->attributes['leadership']));
        } else {
            return $this->attributes['leadership'];
        }
    }

    //Mutators
    public function setLeadershipAttribute($value)
    {
        if (strlen($value) >= 2 && $this->attributes['squadron_counter']) {
            $this->attributes['leadership'] = preg_replace('/\D/', '', $value);
        } else {
            $this->attributes['leadership'] = $value;
        }
    }



    //TODO: not used currently, doesnt work with Pivots. Switching FleetShip to extend Model would make it work but needs refactoring of half of the backend logic
    //      nevertheless I still advocate for this incredible refactoring endeavour because of many factors - simply put this should be a 1st class Model
    public function deepClone(int $newFleetId) : FleetShip
    {
        $clone = $this->replicate();
        $clone->fleet_id = $newFleetId;
        $clone->save();

        // Cascade replicate related objects
        foreach ($this->armamentRefits as $refit) {
            $clone->armamentRefits()->create($refit->replicate()->toArray());
        }

        foreach ($this->additionalRules as $rule) {
            $clone->additionalRules()->create($rule->replicate()->toArray());
        }

        $clone->appliedRefits()->sync($this->appliedRefits->pluck('id'));

        return $clone;
    }
}
