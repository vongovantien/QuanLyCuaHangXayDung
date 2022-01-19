<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderOutput extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('order_outputs')->insert([
                'customer_id' => $faker->numberBetween($min = 1, $max = 20),
                'employee_id' => $faker->numberBetween($min = 1, $max = 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
