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
        'ingredient_id',
        'recipe_id',
        'ingredient_amount'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
