<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;

    // restaurants relationship (many-to-many)
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_typology');
    }
}
