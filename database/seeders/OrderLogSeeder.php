<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderLogs = [
            [
                'quantity' => 10,
                'satuan' => 'Kg',
                'price' => 10000,
            ],
            [
                'quantity' => 5,
                'satuan' => 'Kg',
                'price' => 5000,
            ],
            [
                'quantity' => 3,
                'satuan' => 'Liter',
                'price' => 15000,
            ],
            [
                'quantity' => 2,
                'satuan' => 'Kg',
                'price' => 20000,
            ],
            [
                'quantity' => 1,
                'satuan' => 'Kg',
                'price' => 50000,
            ]
        ];

        $supplierID = DB::table('suppliers')->pluck('id');
        $inventoryID = DB::table('inventories')->pluck('id');

        foreach ($orderLogs as $orderLog){
          $orderLogId = DB::table('inventories')->insertGetId($orderLog);
          
          DB::table('inventories')->where('id', $orderLogId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);

            DB::table('inventories')->where('id', $orderLogId)->update([
                'supplier_id' => $supplierID->random(),
                'inventory_id' => $inventoryID->random()
            ]);
        };
    }
}
