<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product_category extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_name",
        'category_image'
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
