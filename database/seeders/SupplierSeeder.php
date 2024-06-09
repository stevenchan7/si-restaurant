<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Beras Sejahtera',
                'email' => 'berassejahter@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1',
            ],
            [
                'name' => 'PT. Gula Manis',
                'email' => 'gulamanis@gmail.com',
                'phone' => '081234567891',
                'address' => 'Jl. Raya No. 2',
            ],
            [
                'name' => 'PT. Minyak Goreng',
                'email' => 'minyakgoreng@gmail.com',
                'phone' => '081234567892',
                'address' => 'Jl. Raya No. 3',
            ],
            [
                'name' => 'PT. Telur Asin',
                'email' => 'telusasin@gmail.com',
                'phone' => '081234567893',
                'address' => 'Jl. Raya No. 4',
            ],
            [
                'name' => 'PT. Daging Sapi',
                'email' => 'dagingsapi@gmail.com',
                'phone' => '081234567894',
                'address' => 'Jl. Raya No. 5',
            ],
        ];
    }
}
