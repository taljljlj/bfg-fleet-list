<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommanderRerolls extends Model
{
    public $timestamps = false;

    // Relations
    public function commander() {
        return $this->belongsTo(Commander::class);
    }
}
