<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 1; $i <= 5; $i++) {

            $newRestaurant = new Restaurant();

            // Seed one restaurant for each user
            $user = User::where('id', $i)->first();
            $newRestaurant->user_id = $user->id;

            // Mix of faked and static data
            $newRestaurant->name = $faker->company();
            $newRestaurant->slug = Str::slug($newRestaurant->name);
            $newRestaurant->vat_number = rand(1, 500000);
            $newRestaurant->address = $faker->streetAddress();
            $newRestaurant->postal_code = rand(10000, 99999);
            $newRestaurant->city = 'Roma';
            $newRestaurant->business_times = $faker->time();
            $newRestaurant->phone_number = rand(1, 500000);
            $newRestaurant->delivery_cost = 5.2;
            $newRestaurant->min_purchase = 5.2;
            $newRestaurant->image = 'prova';

            $newRestaurant->save();
        }
    }
}