<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'name_en',
        'parent_id',
        'slug',
    ];

    public function paintings()
    {
        return $this->hasMany(Painting::class, 'category_id');
    }
}
