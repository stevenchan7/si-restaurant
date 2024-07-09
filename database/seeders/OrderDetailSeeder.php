<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $menu = Menu::inRandomOrder()->first();
            $qty = rand(1, 5);
            $price = $menu->price;
            $total = $price * $qty;
            $createdAt = Carbon::now()->subMonths(rand(0, 6))->subDays(rand(0, 30));

            OrderDetail::create([
                'menu_id' => $menu->id,
                'qty' => $qty,
                'price' => $price,
                'total' => $total,
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]);
        }
    }
}
