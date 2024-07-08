<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Inventory extends Model
{
    use HasFactory, Notifiable;

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

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderLogs(): HasMany
    {
        return $this->hasMany(OrderLog::class, 'ingredient_id');
    }

    public function menuIngredients(): HasMany
    {
        return $this->hasMany(MenuIngredient::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'ingredient_id');
    }
    
    protected $primaryKey = 'id';
    public $timestamps = true;
}
