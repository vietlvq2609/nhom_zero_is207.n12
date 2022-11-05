<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty_in_stock',
        'price'
    ];
    
    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    public function product_configuration()
    {
        return $this->hasMany(Product_configuration::class, "product_item_id");
    }
    public function order_line()
    {
        return $this->hasMany(Order_line::class, "product_item_id");
    }
}
