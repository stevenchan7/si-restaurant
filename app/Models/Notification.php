<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'content',
        'is_read',
        'ingredient_id',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function ingredient()
    {
        return $this->belongsTo(Inventory::class, 'ingredient_id');
    }

    protected $primaryKey = 'id';
    public $timestamps = true;
}
