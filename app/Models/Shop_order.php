<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'order_total'
    ];

    // Relationships
    public function order_line()
    {
        return $this->hasMany(Order_line::class, 'order_line');
    }
    public function user_payment_method()
    {
        return $this->belongsTo(User_payment_method::class, 'payment_method_id');
    }
    public function shipping_method()
    {
        return $this->belongsTo(Shipping::class, 'shipping_method');
    }
    public function order_status()
    {
        return $this->belongsTo(Order_status::class, 'order_status');
    }
    public function shipping_address()
    {
        return $this->belongsTo(Address::class, 'shipping_address');
    }
}
