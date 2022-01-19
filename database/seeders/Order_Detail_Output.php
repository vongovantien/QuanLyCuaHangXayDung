<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order_Detail_Output extends Seeder
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
            DB::table('order_detail_outputs')->insert([
//                id	warehouse_id	order_output_id	quantity	price	profit	created_at	updated_at
                'warehouse_id' => $faker->numberBetween($min = 1, $max = 3),
                'order_output_id' => $faker->numberBetween($min = 1, $max = 3),
                'quantity' => $faker->numberBetween($min = 10, $max = 500),
                'price' => $faker->numberBetween($min = 1000000, $max = 50000000),
                'profit' => $faker->numberBetween($min = 500000, $max = 5000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
