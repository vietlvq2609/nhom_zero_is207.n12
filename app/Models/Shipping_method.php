<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_method extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price'
    ];

    public function shop_order()
    {
        return $this->hasMany(Shop_order::class, 'shipping_method');
    }
}
