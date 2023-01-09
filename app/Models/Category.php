<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug', 'name', 'image', 'mm_name'
    ];
    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
}
