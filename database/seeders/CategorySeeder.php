<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Fast-food', 'Pizzeria', 'Sushi', 'Pokè'];

        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($categories as $category) {

            $newCategory = new Category();

            $newCategory->name = $category;
            $newCategory->slug = Str::slug($newCategory->name, '-');

            $newCategory->save();
        }
    }
}
