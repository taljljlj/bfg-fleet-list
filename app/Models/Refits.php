<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refits extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Relations
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_refit', 'refit_id', 'ship_id')
            ->withPivot('points', 'firepower', 'range_speed');
    }

    public static function getRuleByName($name)
    {
        return self::where('name', $name)->first();
    }
}
