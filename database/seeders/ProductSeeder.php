<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = ['Pizza margherita', 'Patatine fritte', 'Hamburger classico', 'Insalatina fresca', 'Hot dog'];
        $restaurant = 1;

        foreach ($products as $product) {

            $newProduct = new Product();

            $newProduct->restaurant_id = $restaurant;
            $newProduct->name = $product;
            $newProduct->slug = Str::slug($newProduct->name, '-');
            $newProduct->description = 'Buonissimo, diffidate dalle imitazioni!';
            $newProduct->ingredients = 'Quello che avevamo in cucina';
            $newProduct->image = $faker->imageUrl(360, 360, 'food', true);
            $newProduct->price = $faker->randomFloat(2, 1, 20);
            $newProduct->discount = 0;
            $newProduct->is_visible = 1;
            
            $restaurant++;
            $newProduct->save();

        }
    }
}
