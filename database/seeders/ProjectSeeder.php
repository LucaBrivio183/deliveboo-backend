<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->name = $faker->words(3, true);
            $project->description = $faker->sentence();
            $project->major_version = $faker->numberBetween(1, 10);
            $project->minor_version = $faker->numberBetween(1, 10);
            $project->patch_version = $faker->numberBetween(1, 10);
            $project->slug = Str::slug($project->name, '-');
            $project->save();
        }
    }
}
