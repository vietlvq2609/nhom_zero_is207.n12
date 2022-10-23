<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function shop_order()
    {
        return $this->hasMany(Shop_order::class, 'order_status');
    }
}
