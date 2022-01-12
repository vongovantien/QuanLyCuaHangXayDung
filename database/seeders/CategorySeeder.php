<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('categories')->insert([
                'name' => $faker->name,
                'description' => Str::random(50),
                'active' => $faker->randomElement(['1']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
