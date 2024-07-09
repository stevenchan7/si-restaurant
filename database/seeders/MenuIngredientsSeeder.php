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
        $recipes = DB::table('recipes')->get();
        $menuIngredients = [
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.3,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.2,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.15,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.23,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.5,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.1,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.6,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.10,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.25,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.35,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.03,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.01,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.02,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.05,
            ],
            [
                'recipe_id' => $this->getRandomRecipesId($recipes),
                'ingredient_id' => $this->getRandomIngredientsId($ingredients),
                'ingredient_amount' => 0.07,
            ],
        ];

        foreach ($menuIngredients as $menuIngredient){
          $menuIngredientId = DB::table('menu_ingredients')->insertGetId($menuIngredient);

        }
    }

    private function getRandomIngredientsId($ingredients)
    {
        return $ingredients->random()->id;
    }
    private function getRandomRecipesId($recipes)
    {
        return $recipes->random()->id;
    }
}
