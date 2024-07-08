<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function menuIngredient(): HasMany
    {
        return $this->hasMany(MenuIngredient::class);
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
