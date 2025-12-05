<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'total_price',
        'status',
        'decription',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    
}
