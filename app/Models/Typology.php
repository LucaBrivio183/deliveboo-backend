<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Locate the image in the storage directory
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value !== null ? asset('storage/' . $value) : null,
        );
    }
}
