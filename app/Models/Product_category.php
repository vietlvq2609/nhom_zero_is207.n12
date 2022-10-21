<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;

    // Relationship with Product_category
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
