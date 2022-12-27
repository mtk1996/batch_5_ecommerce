<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'phone', 'description'];

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }

    public  function product()
    {
        return $this->hasMany(Product::class);
    }

    public  function addTransaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }
}
