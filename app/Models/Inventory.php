<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'name',
        'stock',
        'satuan',
        'price',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp' . number_format($this->price, 0, ',', '.');
    }

    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public function orderLog(): BelongsTo
    {
        return $this->belongsTo(OrderLog::class);
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
