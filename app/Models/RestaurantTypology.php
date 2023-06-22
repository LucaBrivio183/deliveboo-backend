<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Relations\Pivot;
 
class RestaurantTypology extends Pivot
{    
    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = true;
}