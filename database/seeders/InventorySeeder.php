<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Supplier;
use App\Models\Inventory;
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
        $suppliers = Supplier::all();
        $inventories = [
            [
                'name' => 'Beras',
                'stock' => 0,
                'unit' => 'Kg',
                'price' => 10000,
                'minimum_stock' => 20,
                'supplier_id' => $this->getRandomSupplierId($suppliers),
            ],
            [
                'name' => 'Gula',
                'stock' => 0,
                'unit' => 'Kg',
                'price' => 5000,
                'minimum_stock' => 10,
                'supplier_id' => $this->getRandomSupplierId($suppliers),
            ],
            [
                'name' => 'Minyak Goreng',
                'stock' => 0,
                'unit' => 'Liter',
                'price' => 15000,
                'minimum_stock' => 5,
                'supplier_id' => $this->getRandomSupplierId($suppliers),
            ],
            [
                'name' => 'Telur',
                'stock' => 0,
                'unit' => 'Krat',
                'price' => 20000,
                'minimum_stock' => 10,
                'supplier_id' => $this->getRandomSupplierId($suppliers),
            ],
            [
                'name' => 'Daging Sapi',
                'stock' => 0,
                'unit' => 'Kg',
                'price' => 50000,
                'minimum_stock' => 5,
                'supplier_id' => $this->getRandomSupplierId($suppliers),
            ],
        ];

        foreach ($inventories as $inventory){
          $InventoryId = DB::table('ingredients')->insertGetId($inventory);
          
          DB::table('ingredients')->where('id', $InventoryId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);

        };
    }

    private function getRandomSupplierId($suppliers)
    {
        return $suppliers->random()->id;
    }
}