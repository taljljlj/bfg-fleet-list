<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetList extends Model
{
    public $timestamps = false;

    //Relations
    public function faction() {
        return $this->belongsTo(Faction::class);
    }

    public function ships() {
        return $this->belongsToMany(Ship::class, 'fleet_list_ship');
    }


    /**
     * Get fleet list objects by faction_id
     * @param int $factionId
     * @return Collection
     */
    public static function getByFactionId(int $factionId) : Collection {
        return self::where('faction_id', $factionId)->get();
    }

    /**
     * Get related ships grouped by ship type. Used for ship sorting.
     * @return Collection
     */
    public function getShipsGroupedByType() {
        return $this->ships()->get()->groupBy('type');
    }
}
