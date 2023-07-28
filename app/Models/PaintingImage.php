<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaintingImage extends Model
{
    use HasFactory;

    protected $table = 'paintings_images';

    protected $fillable = [
        'painting_id',
        'hash_id',
        'width',
        'height'
    ];
}
