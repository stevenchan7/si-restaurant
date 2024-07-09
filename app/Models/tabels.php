<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'table_number',
        'capacity',
        'table_status'
    ];

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
