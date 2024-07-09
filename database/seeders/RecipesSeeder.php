<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'name' => 'Nasi Goreng',
            ],
            [
                'name' => 'Mie Goreng',
            ],
            [
                'name' => 'Ayam Goreng',
            ],
            [
                'name' => 'Ayam Bakar',
            ],
            [
                'name' => 'Ayam Kecap',
            ],
            [
                'name' => 'Ayam Rica-Rica',
            ],
            [
                'name' => 'Ayam Geprek',
            ],
            [
                'name' => 'Ayam Penyet',
            ],
            [
                'name' => 'Ayam Sambal Matah',
            ],
        ];

        foreach ($recipes as $recipe) {
          Recipe::create($recipe);
      }
    }
}