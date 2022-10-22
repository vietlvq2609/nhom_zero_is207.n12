<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_name"
    ];

    // Relationship
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function promotion_category()
    {
        return $this->hasMany(Promotion_category::class, 'category_id');
    }
}
