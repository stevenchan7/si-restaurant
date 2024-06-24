<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'table_id',
        'customer_email',
        'date',
        'start_time',
        'end_time',
        'reservation_status'
    ];

    public function table() 
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
