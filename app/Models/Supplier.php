<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function inventory(): HasMany {
        return $this->hasMany(Inventory::class);
    }

    public function orderLog(): BelongsTo
    {
        return $this->belongsTo(OrderLog::class);
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
