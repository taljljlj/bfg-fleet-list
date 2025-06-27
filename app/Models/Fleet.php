<?php

namespace App\Models;

use App\Models\FleetBuilder\FleetShip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    //Relations
    public function faction() {
        return $this->belongsTo(Faction::class);
    }

    public function fleetList() {
        return $this->belongsTo(FleetList::class);
    }

    public function ships() {
        return $this->belongsToMany(Ship::class)->using(FleetShip::class)->withTimestamps();
    }

    public function shipsInFleetList(FleetList $fleetList) {
        return $this->ships()
            ->whereHas('fleetLists', function ($query) use ($fleetList) {
                $query->where('fleet_list_id', $fleetList->id);
            });
    }
}
