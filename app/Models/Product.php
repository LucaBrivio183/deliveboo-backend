<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['slug', 'image'];
    // restaurant relationship (many-to-one)
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // category relationship (many-to-one)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // orders relationship (many-to-many)
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
