<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [ 'css', 'html', 'javascript', 'php', 'laravel', 'symfony', 
        'vue', 'react', 'angular', 'node', 'python', 'c++' ];

        foreach($technologies as $technology) {
            
            $technologies = new Technology();
            $technologies->name = $technology;
            $technologies->slug = Str::slug($technology);
            $technologies->save();
        }
    }
}
