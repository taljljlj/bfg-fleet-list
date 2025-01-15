<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    use HasFactory;

    /**
     * @param string $name
     * @return mixed
     */
    public static function getByName(string $name) {
        return self::where('name', $name)->first();
    }
}
