<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    // Relationship with user_payment_method
    public function user_payment_method()
    {
        return $this->hasMany(User_payment_method::class, 'payment_type_id');
    }
}
