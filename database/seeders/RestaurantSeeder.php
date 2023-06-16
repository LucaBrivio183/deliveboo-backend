<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurants');
        
        Schema::disableForeignKeyConstraints();
        Restaurant::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($restaurants as $restaurant){
            $newRestaurant = new Restaurant();
            // Seed one restaurant for each user
            
            $newRestaurant->user_id = $restaurant['user_id'];

            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->slug = $restaurant['slug'];
            $newRestaurant->vat_number = $restaurant['vat_number'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->postal_code = $restaurant['postal_code'];
            $newRestaurant->city = $restaurant['city'];
            $newRestaurant->business_times = $restaurant['business_times'];
            $newRestaurant->phone_number = $restaurant['phone_number'];
            $newRestaurant->delivery_cost = $restaurant['delivery_cost'];
            $newRestaurant->min_purchase = $restaurant['min_purchase'];
            $newRestaurant->image = $restaurant['image'];
            $newRestaurant->save();
        }
   }
}