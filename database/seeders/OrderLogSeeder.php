<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Supplier;

class OrderLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = Supplier::all();
        $inventories = Inventory::all();
        $orderLogs = [
            [
                'supplier_id' => $this->getRandomSupplierId($suppliers),
                'inventory_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 10,
                'satuan' => 'Kg',
                'price' => 10000,
            ],
            [
                'supplier_id' => $this->getRandomSupplierId($suppliers),
                'inventory_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 5,
                'satuan' => 'Kg',
                'price' => 5000,
                
            ],
            [
                'supplier_id' => $this->getRandomSupplierId($suppliers),
                'inventory_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 3,
                'satuan' => 'Liter',
                'price' => 15000,
            ],
            [
                'supplier_id' => $this->getRandomSupplierId($suppliers),
                'inventory_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 2,
                'satuan' => 'Kg',
                'price' => 20000,
            ],
            [
                'supplier_id' => $this->getRandomSupplierId($suppliers),
                'inventory_id' => $this->getRandomInventoryId($inventories),
                'quantity' => 1,
                'satuan' => 'Kg',
                'price' => 50000,
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

    private function getRandomSupplierId($suppliers)
    {
        return $suppliers->random()->id;
    }

    private function getRandomInventoryId($inventories)
    {
        return $inventories->random()->id;
    }
}
