<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = ['Frontend', 'Backend', 'Fullstack', 'Database', 'Other' , 'DevOps'];

        foreach ($type as $type_name) {

            $new_type = new Type();
            $new_type->name = $type_name;
            $new_type->slug = Str::slug($type_name);
           
            $new_type->save();

        }
        
    }
}
