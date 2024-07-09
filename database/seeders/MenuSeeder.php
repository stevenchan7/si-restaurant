<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        for ($i = 0; $i < 10; $i++) {
            Menu::create([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->numberBetween(100000, 150000),
                'base_price' => $faker->numberBetween(50000, 100000),
                'discount' => $faker->numberBetween(0, 50),
                'category_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
