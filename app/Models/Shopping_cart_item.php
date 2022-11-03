<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_cart_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'cart_id',
        'product_item_id'
    ];

    // Relationships
    public function shopping_cart() {
        return $this->belongsTo(Shopping_cart::class, 'cart_id');
    }
    public function product_item()
    {
        return $this->belongsTo(Product_item::class, 'product_item_id');
    }
}
