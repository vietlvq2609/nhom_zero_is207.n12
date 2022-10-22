<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_option extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];

    // Relationships
    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id');
    }
    public function product_configuration()
    {
        return $this->hasMany(Product_configuration::class, 'variation_option_id');
    }
}
