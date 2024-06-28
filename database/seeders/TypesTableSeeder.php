<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 4; $i++) {
            $newType = new Type();
            $newType->name = $faker->sentence(3);
            $newType->description = $faker->text(500);
            $newType->save();
        }
    }
}
