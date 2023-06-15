<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

<<<<<<< HEAD
    //1 to many relation
=======
    // Guarded data will not be auto-filled
    protected $guarded = ['slug', 'image', 'user_id'];

    //product relationship
>>>>>>> 1af474be9af1c65376ce1591a5c454c9a4e817c1
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
