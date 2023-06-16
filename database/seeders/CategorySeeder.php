<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
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
        $categories = config('categories');

        foreach ($categories as $category) {

            $newCategory = new Category();

            $newCategory->name = $category['name'];
            $newCategory->slug = Str::slug($newCategory->name, '-');

            $newCategory->save();
        }
    }
}
