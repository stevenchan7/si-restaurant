<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'fullname' => 'Timothy Ronald',
            'address' => 'Jalan Bitcoin, Kajarta',
            'telephone_number' => '+6233555666777',
            'email' => 'timothy@gmail.com',
            'start_working_date' => Carbon::now()->toDateString()
        ]);

        Employee::create([
            'fullname' => 'Kalimasada',
            'address' => 'Jalan Bitcoin, Kajarta',
            'telephone_number' => '+6233555666777',
            'email' => 'kalimasada@gmail.com',
            'start_working_date' => Carbon::now()->toDateString()
        ]);
    }
}
