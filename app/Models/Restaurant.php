<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Guarded data will not be auto-filled
    protected $guarded = ['slug', 'image', 'user_id', 'delivery_cost', 'min_purchase'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    //product relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //typologies relationship
    public function typologies()
    {
        return $this->belongsToMany(Typology::class, 'restaurant_typology');
    }
}
