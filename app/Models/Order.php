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
        'discount_code',
        'discount_amount',
        'user_id',

    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
