<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->belongsToMany(Order::class)->withPivot('quantity');
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
