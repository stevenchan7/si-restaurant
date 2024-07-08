<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

