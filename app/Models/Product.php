<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_image'
    ];

    public function scopeCategory($query, array $filters)
    {
        if ($filters['category'] ?? false) {
            $query->whereIn('category_id', explode(',', request('category')))
            ->orWhereHas('product_category', function (Builder $query) {
                $query->whereIn('parent_category_id', explode(',', request('category')));
            });
        }
    }
    public function scopeMinPrice($query, array $filters)
    {
        if ($filters['min_price'] ?? false) {
            $query->whereHas('product_item', function (Builder $query) {
                $query->where('price', '>=', request('min_price'));
            });
        }
    }
    public function scopeMaxPrice($query, array $filters)
    {
        if ($filters['max_price'] ?? false) {
            $query->whereHas('product_item', function (Builder $query) {
                $query->where('price', '<=', request('max_price'));
            });
        }
    }

    public function scopeSearch($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request("search") . '%')
                ->orWhere('description', 'like', '%' . request("search") . '%'); 
        }
    }

    public function product_category()
    {
        return $this->belongsTo(Product_category::class, 'category_id');
    }
    public function product_item()
    {
        return $this->hasMany(Product_item::class, 'product_id');
    }
}
