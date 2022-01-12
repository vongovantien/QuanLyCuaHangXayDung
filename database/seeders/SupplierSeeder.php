<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SupplierSeeder extends Seeder
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
            DB::table('suppliers')->insert([
                'name' => $faker->name,
                'address' => Str::random(50),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->regexify('0[0-9]{9}'),
            ]);
        }
    }
}
