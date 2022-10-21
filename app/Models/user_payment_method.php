<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_payment_method extends Model
{
    use HasFactory;

    // Relationship with shop_order
    public function shop_order()
    {
        return $this->belongsTo(shop_order::class, 'id');
    }
    // Relationship with user
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    // Relationship with payment_type
    public function payment_type()
    {
        return $this->belongsTo(payment_type::class, 'payment_type_id');
    }
}
