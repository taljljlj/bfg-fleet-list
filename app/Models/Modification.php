<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    public $timestamps = false;

    //Relations
    public function refit() {
        return $this->belongsTo(Refit::class);
    }

    public function ship() {
        return $this->belongsToMany(Ship::class, 'ship_modification')
            ->withPivot('firepower', 'range_speed', 'misc');
    }

    public function scopeByRefitName($query, $refitName)
    {
        return $query->whereHas('refit', function ($q) use ($refitName) {
            $q->where('name', $refitName);
        });
    }
}
