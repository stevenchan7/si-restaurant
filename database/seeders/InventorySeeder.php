<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InventorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $inventories = [
            [
                'name' => 'Beras',
                'stock' => 100,
                'satuan' => 'Kg',
                'price' => 10000,
            ],
            [
                'name' => 'Gula',
                'stock' => 50,
                'satuan' => 'Kg',
                'price' => 5000,
            ],
            [
                'name' => 'Minyak Goreng',
                'stock' => 30,
                'satuan' => 'Liter',
                'price' => 15000,
            ],
            [
                'name' => 'Telur',
                'stock' => 20,
                'satuan' => 'Kg',
                'price' => 20000,
            ],
            [
                'name' => 'Daging Sapi',
                'stock' => 10,
                'satuan' => 'Kg',
                'price' => 50000,
            ],
        ];

        $supplierID = DB::table('suppliers')->pluck('id');

        foreach ($inventories as $inventory){
          $InventoryId = DB::table('inventories')->insertGetId($inventory);
          
          DB::table('inventories')->where('id', $InventoryId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);

          DB::table('inventories')->where('id', $InventoryId)->update([
              'supplier_id' => $supplierID->random()
          ]);
        };
    }
}