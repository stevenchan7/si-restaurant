<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderLog extends Model
{
    use HasFactory;

    protected $table = 'order_logs';
    
    protected $fillable = [
        'employee_id',
        'order_amount',
        'total_price',
        'ingredient_id',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'ingredient_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function getPriceFormat($value): string
    {
        return 'Rp' . number_format($value, 0, ',', '.');
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
