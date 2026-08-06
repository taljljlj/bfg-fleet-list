<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commander extends Model
{
    public $timestamps = false;

    //Relations
    public function faction(){
        return $this->belongsTo(Faction::class);
    }
    public function fleetLists ()
    {
        return $this->belongsToMany(FleetList::class, 'fleet_list_commanders');
    }

    public function commanderRerolls () {
        return $this->hasMany(CommanderRerolls::class);
    }

    public function rule() {
        return $this->belongsTo(Rules::class);
    }
}
