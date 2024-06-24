<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = DB::table('ingredients')->get();
        $menuIngredients = [
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 10,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 5,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 3,
            ],
            [
 
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 2,
            ],
            [
 
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 1,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 10,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 5,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 3,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 2,
            ],
            [
                'ingredient_id' => $this->getRandomSupplierId($ingredients),
                'ingredient_quantity' => 1,
            ],
        ];

        foreach ($menuIngredients as $menuIngredient){
          $menuIngredientId = DB::table('menu_ingredients')->insertGetId($menuIngredient);

        }
    }

    private function getRandomSupplierId($ingredients)
    {
        return $ingredients->random()->id;
    }
}
