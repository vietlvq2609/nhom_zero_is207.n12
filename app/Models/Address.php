<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'street_number',
        'address_line1',
        'address_line2',
        'city',
        'region',
        'postal_code',
        'country_id'
    ];

    // Relationships
    public function user_address()
    {
        return $this->hasMany(User_address::class, 'address_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function shop_order()
    {
        return $this->hasMany(Shop_order::class, 'shipping_address');
    }
}
