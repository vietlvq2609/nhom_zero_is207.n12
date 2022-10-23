<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_image'
    ];

    // Relationship with Product_category
    public function product_category()
    {
        return $this->belongsTo(Product_category::class, 'category_id');
    }
    public function product_item()
    {
        return $this->hasMany(Product_item::class, 'product_id');
    }
}
