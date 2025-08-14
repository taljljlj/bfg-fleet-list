<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armament extends Model
{
    public $timestamps = false;

    protected $appends = ['fire_arc_short'];

    //Relations
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_armament')
            ->withPivot('range_speed', 'firepower');
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
