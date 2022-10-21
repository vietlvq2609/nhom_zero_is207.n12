<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line',
        'city'
    ];

    // Relationship With User_Address
    public function user_address()
    {
        return $this->hasMany(User_Address::class, 'address_id');
    }
}
