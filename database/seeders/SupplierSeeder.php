<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $suppliers = [
            [
                'name' => 'PT Indah Jaya',
                'email' => 'berassejahtera@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1',
            ],
            [
                'name' => 'PT. Masyarakat',
                'email' => 'gulamanis@gmail.com',
                'phone' => '081234567891',
                'address' => 'Jl. Raya No. 2',
            ],
            [
                'name' => 'PT. Bakti Gila',
                'email' => 'minyakgoreng@gmail.com',
                'phone' => '081234567892',
                'address' => 'Jl. Raya No. 3',
            ],
            [
                'name' => 'PT. Wibu Lapar',
                'email' => 'telusasin@gmail.com',
                'phone' => '081234567893',
                'address' => 'Jl. Raya No. 4',
            ],
            [
                'name' => 'PT. Makan Enak',
                'email' => 'dagingsapi@gmail.com',
                'phone' => '081234567894',
                'address' => 'Jl. Raya No. 5',
            ],
            
        ];
       
        foreach ($suppliers as $supplier){
          $SupplierId = DB::table('suppliers')->insertGetId($supplier);
          DB::table('suppliers')->where('id', $SupplierId)->update([
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]);
        };
    }
}
