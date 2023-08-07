<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    use HasFactory;

    protected $table = 'paintings';

    protected $fillable = [
        'name_ua',
        'name_en',
        'price',
        'description_ua',
        'description_en',
        'year',
        'material_ua',
        'material_en',
        'style_ua',
        'style_en',
        'height',
        'long',
        'sold_status',
        'slug',
        'order',
        'category_id'
    ];

    public function images()
    {
        return $this->hasMany(PaintingImage::class, 'painting_id');
    }
}
