<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table = 'view_product';
    protected $fillable = [
        'views',
        'product_id',
        'date',
        'hour',
        'minute',
    ];
}
