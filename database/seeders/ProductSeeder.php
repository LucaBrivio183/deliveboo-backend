<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = config('products');

        foreach ($products as $product) {

            $newProduct = new Product();

            $newProduct->restaurant_id = $product['restaurant_id'];
            $newProduct->name = $product['name'];
            $newProduct->slug = Str::slug($newProduct->name, '-');
            $newProduct->description = $product['description'];
            $newProduct->ingredients = $product['ingredients'];
            $newProduct->image = $product['image'];
            $newProduct->price = $product['price'];
            $newProduct->discount = 0;
            $newProduct->is_visible = 1;
            
            $newProduct->save();

        }
    }
}
