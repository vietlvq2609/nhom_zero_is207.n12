<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_payment_method extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'provider',
        'account_number',
        'expiry_date',
        'is_default',
    ];

    // Relationship with shop_order
    public function shop_order()
    {
        return $this->hasMany(Shop_order::class, 'payment_method_id');
    }
    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relationship with payment_type
    public function payment_type()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type_id');
    }
}
