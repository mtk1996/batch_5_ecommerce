<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id', 'supplier_id', 'name', 'image',
        'description', 'stock_qty', 'sale_price', 'discounted_price',
    ];

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }
    public  function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
    public function brand()
    {
        return $this->belongsTo(Product::class);
    }
    public function review()
    {
        return $this->belongsTo(ProductReview::class);
    }
    public function productAddTransaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }
    public function productRemoveTransaction()
    {
        return $this->hasMany(ProductRemoveTransaction::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
