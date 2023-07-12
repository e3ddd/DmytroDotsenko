<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    use HasFactory;

    protected $table = 'paintings';

    protected $fillable = [
        'name',
        'name_en',
        'price',
        'description',
        'description_en',
        'year',
        'width',
        'height',
        'long',
        'sold_status'
    ];

    public function images()
    {
        return $this->hasMany(PaintingImage::class, 'painting_id');
    }
}
