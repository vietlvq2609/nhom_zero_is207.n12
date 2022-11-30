<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_line extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_item_id',
        'order_id',
        'qty',
        'price'
    ];

    public function user_review()
    {
        return $this->hasMany(User_review::class, 'ordered_product_id');
    }
    public function product_item()
    {
        return $this->belongsTo(Product_item::class, 'product_item_id');
    }
    public function shop_order()
    {
        return $this->belongsTo(Shop_order::class, 'order_id');
    }
}
