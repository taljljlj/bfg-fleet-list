<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Faction extends Model
{
    public $timestamps = false;

    //Relations
    public function fleetLists() {
        return $this->hasMany(FleetList::class);
    }
    public function ships() {
        return $this->hasMany(Ship::class)->with('armaments');
    }

    //Accessors
    public function getHotpickFactionImgUrlAttribute() {
        return Str::kebab($this->name) . '-hotpick.png';
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function getByName(string $name) {
        return self::where('name', $name)->first();
    }
}
