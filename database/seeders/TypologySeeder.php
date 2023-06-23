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
        $typologies = ['Pizza', 'Kebab', 'Hamburger', 'Cucina italiana', 'Poke', 'Piadina'];

        foreach($typologies as $typology) {
            $newTypology = new Typology();

            $newTypology->name = $typology;
            $newTypology->slug = Str::slug($typology);
            $newTypology->image = 'https://www.visitdubai.com/-/media/images/leisure/campaigns/delicious-dubai-nordics/nordics-campaign-arabic-food-dubai-header-2.jpg?&cw=256&ch=256';

            $newTypology->save();
        }
    }
}
