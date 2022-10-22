<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_payment_method extends Model
{
    protected $fillable = [
        'provider',
        'account_number',
        'expiry_date',
        'is_default',
    ];
    use HasFactory;

    // Relationship with shop_order
    public function Shop_order()
    {
        return $this->belongsTo(Shop_order::class, 'id');
    }
    // Relationship with user
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relationship with payment_type
    public function Payment_type()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type_id');
    }
}
