<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\OrderLog;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateForeignKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update suppliers dengan foreign key ke inventories
        Supplier::all()->each(function ($supplier) {
            $inventory = Inventory::inRandomOrder()->first();
            $supplier->inventory_id = $inventory->id;
            $supplier->save();
        });

         // Update inventories dengan foreign key ke suppliers
         Inventory::all()->each(function ($inventory) {
            $supplier = Supplier::inRandomOrder()->first();
            $inventory->supplier_id = $supplier->id;
            $inventory->save();
        });

        // Update order_logs dengan foreign key ke suppliers dan inventories
        OrderLog::all()->each(function ($orderLog) {
            $supplier = Supplier::inRandomOrder()->first();
            $inventory = Inventory::inRandomOrder()->first();
            $orderLog->supplier_id = $supplier->id;
            $orderLog->inventory_id = $inventory->id;
            $orderLog->save();
        });
    }
}
