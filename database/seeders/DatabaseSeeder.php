<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            RoleSeeder::class
        ]);
        $this->call([
            SupplierSeeder::class
        ]);
        $this->call([
            InventorySeeder::class
        ]);
        // $this->call([
        //     OrderLogSeeder::class
        // ]);
        $this->call([
            RecipesSeeder::class
        ]);
        $this->call([
            MenuIngredientsSeeder::class
        ]);
    }
}
