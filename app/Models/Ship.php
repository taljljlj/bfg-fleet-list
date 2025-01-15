<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    public function armaments() {
        return $this->belongsToMany(Armament::class, 'ship_armaments')
                    ->withPivot('placement', 'fire_arc', 'range_speed', 'firepower');
    }
}
