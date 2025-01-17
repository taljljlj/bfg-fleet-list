<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armament extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_armaments')
            ->withPivot('placement', 'fire_arc', 'range_speed', 'firepower');
    }
}
