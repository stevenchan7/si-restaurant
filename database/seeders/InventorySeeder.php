<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
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
                'quantity' => 100,
                'satuan' => 'Kg',
                'price' => 10000,
                'supplier' => 'PT. Beras Sejahtera'
            ],
            [
                'name' => 'Gula',
                'quantity' => 50,
                'satuan' => 'Kg',
                'price' => 5000,
                'supplier' => 'PT. Gula Manis'
            ],
            [
                'name' => 'Minyak Goreng',
                'quantity' => 30,
                'satuan' => 'Liter',
                'price' => 15000,
                'supplier' => 'PT. Minyak Sehat'
            ],
            [
                'name' => 'Telur',
                'quantity' => 20,
                'satuan' => 'Kg',
                'price' => 20000,
                'supplier' => 'PT. Telur Asin'
            ],
            [
                'name' => 'Daging Sapi',
                'quantity' => 10,
                'satuan' => 'Kg',
                'price' => 50000,
                'supplier' => 'PT. Daging Sapi'
            ],
        ];

        foreach ($inventories as $inventory){
          $InventoryId = DB::table('inventories')->insertGetId($inventory);
          
          DB::table('inventories')->where('id', $InventoryId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);
        };
    }
}