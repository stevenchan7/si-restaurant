<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Inventory;

class MenuIngredient extends Model
{
    use HasFactory;

    protected $table = 'menu_ingredients';

    protected $fillable = [
        'ingredient_amount'
    ];

    public function inventory(): HasMany {
        return $this->hasMany(Inventory::class);
    }

    protected $primaryKey = 'ingredient_id';
    public $timestamps = true;
}
