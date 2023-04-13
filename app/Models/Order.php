<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'session_id',
        'status',
        'user_id',
        'amount'
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
