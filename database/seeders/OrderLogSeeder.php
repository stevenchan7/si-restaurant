<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;

class OrderLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = Inventory::all();
        $orderLogs = [
            [
                'ingredient_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 10,
                'price' => 1000,
                'total_price' => 1000 * 10,
            ],
            [
                'ingredient_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 5,
                'price' => 5000,
                'total_price' => 5 * 5000,
            ],
            [
                'ingredient_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 3,
                'price' => 15000,
                'total_price' => 3 * 15000,
            ],
            [
                'ingredient_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 2,
                'price' => 20000,
                'total_price' => 2 * 20000,
            ],
            [
                'ingredient_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 1,
                'price' => 50000,
                'total_price' => 1 * 50000,
            ]
        ];

        foreach ($orderLogs as $orderLog){
          $orderLogId = DB::table('order_logs')->insertGetId($orderLog);
          
          DB::table('order_logs')->where('id', $orderLogId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);

        };
    }

    private function getRandomInventoryId($inventories)
    {
        return $inventories->random()->id;
    }
}
