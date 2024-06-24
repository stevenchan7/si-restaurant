<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'stock',
        'unit',
        'price',
        'minimum_stock',
        'supplier_id',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp' . number_format($this->price, 0, ',', '.');
    }

    // public function getFormattedCreatedAtAttribute()
    // {
    //     return $this->created_at->format('F j, Y, g:i a');
    // }

    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public function orderLog(): BelongsTo
    {
        return $this->belongsTo(OrderLog::class);
    }

    public function menuIngredient(): HasMany {
        return $this->hasMany(MenuIngredient::class);
    }

    // public function menuIngredient(): BelongsTo {
    //     return $this->belongsTo(MenuIngredient::class);
    // }

    protected $primaryKey = 'id';
    public $timestamps = true;
}