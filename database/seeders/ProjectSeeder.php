<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use App\Models\Type;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $type = Type::all();
        $ids = $type->pluck('id');
        $technologies = Technology::all();
        $ids_tech = $technologies->pluck('id');

        for ($i = 0; $i < 100; $i++) {
           $new_project = new Project();

           $new_project->title = $faker->sentence(5);
           $new_project->content = $faker->text(500);
           $new_project->slug = Str::slug($new_project->title, '-');
           $new_project->type_id = $faker->optional()->randomElement($ids);
           
           $new_project->save();
           $new_project->technologies()->attach($faker->randomElements($ids_tech, null));
        }
    }
}
