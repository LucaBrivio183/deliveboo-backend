<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
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

        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($products as $product) {

            $newProduct = new Product();

            $newProduct->category_id = $product['category_id'];
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
