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
        $typologies = config('typologies');

        foreach($typologies as $typology) {
            $newTypology = new Typology();

            $newTypology->name = $typology['name'];
            $newTypology->slug = $typology['slug'];
            $newTypology->image = $typology['image'];

            $newTypology->save();
        }
    }
}
