<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Relations
    public function ships() {
        return $this->belongsToMany(Ship::class, 'ship_rule', 'rule_id', 'ship_id');
    }

    public static function getRuleByName($name)
    {
        return self::where('name', $name)->first();
    }
}
