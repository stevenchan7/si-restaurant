<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'base_price',
        'discount',
        'category_id'
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'menu_id');
    }
}
