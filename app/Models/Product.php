<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'decription',
        'price',
        'discount_price',
        'stock',
        'sku',
        'category_id',
        'status',
    ];


    //Quan hệ với Category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::saving(function ($product) {
            if ($product->stock == 0) {
                $product->status = 0; // Hết hàng
            } elseif ($product->stock <= 5) {
                $product->status = 2; // Sắp hết
            } else {
                $product->status = 1; // Còn hàng
            }
        });
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
