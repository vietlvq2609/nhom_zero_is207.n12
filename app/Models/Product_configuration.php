<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_configuration extends Model
{
    use HasFactory;

    protected $fillable = [];

    // Relationships
    public function product_item()
    {
        return $this->belongsTo(Product_item::class, 'product_item_id');
    }
    public function variation_option()
    {
        return $this->belongsTo(Variation_option::class, 'variation_option_id');
    }
}
