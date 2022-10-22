<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion_category extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, "promotion_id");
    }

    public function product_category()
    {
        return $this->belongsTo(Product_category::class, "category_id");
    }
}
