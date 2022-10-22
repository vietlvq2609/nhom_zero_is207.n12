<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relationships
    public function variation_option() {
        return $this->hasMany(Variation_option::class, 'variation_id');
    }
    public function product_category()
    {
        return $this->belongsTo(Product_category::class, 'category_id');
    }
}
