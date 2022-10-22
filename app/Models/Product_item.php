<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'qty_in_stock',
        'product_image',
        'price'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
