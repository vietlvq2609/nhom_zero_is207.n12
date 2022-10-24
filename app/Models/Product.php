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

    public function scopeFilter($query, array $filter) {
        if ($filter['category'] ?? false) {
            return $query->where('category_id' , request('category'));
        }
    }

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
