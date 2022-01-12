<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class   ProductSeeder extends Seeder
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
            DB::table('products')->insert([
                'name' => $faker->name,
                'description' => Str::random(50),
                'unit' => $faker->randomElement(['Tạ', 'Khối','Tấn','Kg', 'Bao', 'Thùng', 'Hộp', 'Cái']),
                'category_id' => $faker->numberBetween($min = 1, $max = 50),
                'supplier_id' => $faker->numberBetween($min = 1, $max = 50),
                'price' => $faker->numberBetween($min = 100000, $max = 15000000),
                'active' => $faker->randomElement(['1', '0']),
                'images' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
