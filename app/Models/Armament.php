<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armament extends Model
{
    use HasFactory;

    public $timestamps = false;

    //Relations
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_armaments')
            ->withPivot('placement', 'fire_arc', 'range_speed', 'firepower');
    }

    //Accessors
    public function getFireArcShortAttribute() {
        $fireArc = $this->fire_arc;
        switch ($fireArc) {
            case 'Left':
                return 'lr';
            case 'Right':
                return 'lr';
            case 'Front':
                return 'f';
            case 'Left/Front/Right':
                return 'lfr';
            default:
                return null;
        }
    }
}
