<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Guarded data will not be auto-filled
    protected $guarded = ['slug', 'image', 'user_id', 'delivery_cost', 'min_purchase'];

    // user relationship (one-to-one)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // product relationship (one-to-many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // typologies relationship (many-to-many)
    public function typologies()
    {
        return $this->belongsToMany(Typology::class, 'restaurant_typology');
    }

    // orders relationship (one-to-many)
    public function orders()
    {
        return $this->hasMany(Order::class);
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
