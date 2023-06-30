<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = Product::all();
        $startOfYear = Carbon::create(2023, 1, 1);

        for ($i = 1; $i <= 100; $i++) {

            $timestamp = $startOfYear->copy()->addDays($faker->numberBetween(0, 364))->addMinutes($faker->numberBetween(0, 1439));
            $newOrder = new Order();

            $newOrder->restaurant_id = 1;
            $newOrder->name = $faker->name();
            $newOrder->email = $faker->email();
            $newOrder->address = $faker->streetAddress();
            $newOrder->phone_number = $faker->e164PhoneNumber() ;
            $newOrder->total_price = rand(100, 1000) / 10;
            $newOrder->created_at = $timestamp;
            $newOrder->updated_at = $timestamp;

            $newOrder->save();

            $productsWithQuantities = $products->random(rand(1, 5))->mapWithKeys(function ($product) {
                return [$product->id => ['quantity' => rand(1, 5)]];
            });

            // $newOrder->products()->attach($productsWithQuantities);
            $newOrder->products()->attach($productsWithQuantities->toArray(), [
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        };
    }
}