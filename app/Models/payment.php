<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','payment_method','total','payment_status','payment_date'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}