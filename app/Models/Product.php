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
        'description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'category_id',
        'image',
        'gallery',
        'status',
    ];

    
    //Quan hệ với Category
     
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    //Lấy gallery dạng mảng nếu lưu JSON
     
    public function getGalleryAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
