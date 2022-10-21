<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_type extends Model
{
    use HasFactory;
    // Relationship with user_payment_method
    public function user_payment_method()
    {
        return $this->hasMany(user_payment_method::class, 'payment_type_id');
    }
}
