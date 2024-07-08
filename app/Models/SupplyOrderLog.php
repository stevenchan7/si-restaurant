<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrderLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_price',
        'qty',
        'total_price',
        'operator_id',
        'ingredient_id'
    ];
}
