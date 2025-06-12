<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refit extends Model
{
    public $timestamps = false;

    //Relations
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_refit', 'refit_id', 'ship_id')
            ->withPivot('points');
    }

    public function modifications() {
        return $this->hasMany(Modification::class);
    }

    public function children() {
        return $this->belongsToMany(Refit::class, 'refit_refit', 'parent_id', 'child_id');
    }

    public function parents()
    {
        return $this->belongsToMany(Refit::class, 'refit_refit', 'child_id', 'parent_id');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function getByName(string $name)
    {
        return self::where('name', $name)->first();
    }

    /**
     * @param array $names
     * @return mixed
     */
    public static function getByNames(array $names)
    {
        return self::whereIn('name', $names)->get();
    }
}
