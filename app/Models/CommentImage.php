<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentImage extends Model
{
    use HasFactory;

    protected $table = 'comments_images';

    protected $fillable = [
        'comment_id',
        'hash_id'
    ];
}
