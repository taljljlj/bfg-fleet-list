<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    //Relations
    public function faction() {
        return $this->belongsTo(Faction::class);
    }

    public function fleetList() {
        return $this->belongsTo(FleetList::class);
    }
}
