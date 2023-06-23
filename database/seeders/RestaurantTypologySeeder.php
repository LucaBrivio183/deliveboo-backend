<?php

namespace Database\Seeders;

use App\Models\RestaurantTypology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RestaurantTypologySeeder extends Seeder
{       
    /**
     * Give every restaurant two typologies. A restaurant can't have two typologies with the same id.
     *
     * @return void
     */
    public function run() {
        
        $oldRestaurantId = '1';
        $oldTypologyId = '0';

        for($i = 1; $i <= 10; $i++) {

            $newRestaurantTypology = new RestaurantTypology();
            
            // Every two cycles, restaurant_id increases by one
            $newRestaurantTypology->restaurant_id = round($i / 2);
            $newRestaurantTypology->typology_id = rand(1, 6);

            // if the restaurant is at its second cycle(already has a typology)
            if($newRestaurantTypology->restaurant_id === $oldRestaurantId) {

                // check if it already has the old typology
                while($newRestaurantTypology->typology_id === $oldTypologyId) {
                    $newRestaurantTypology->typology_id = rand(1, 6);
                }
            }
            
            // Save in variables the restaurant and typology id just created
            $oldRestaurantId = $newRestaurantTypology->restaurant_id;
            $oldTypologyId = $newRestaurantTypology->typology_id;
            
            $newRestaurantTypology->save();
        }
    }
}