<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typologies = ['Pizza', 'Cucina asiatica', 'Sushi', 'Panini', 'Kebab', 'Cucina messicana', 'Thailandese', 'Cucina indiana', 'Hamburgeria', 'Cucina italiana', 'Rosticceria', 'Gelateria', 'Pasticceria', 'Supermercato', 'Piadineria', 'Pokeria', 'Vegetariano', 'Halal', 'Colazione', 'Greco', 'Dessert', 'Cucina libanese', 'Cucina americana'];

        foreach($typologies as $typology) {
            $newTypology = new Typology();

            $newTypology->name = $typology;
            $newTypology->slug = Str::slug($typology);

            $newTypology->save();
        }
    }
}
