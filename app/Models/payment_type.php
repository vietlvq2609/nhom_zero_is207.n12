<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_type extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
    ];
    use HasFactory;
    // Relationship with user_payment_method
    public function User_payment_method()
    {
        return $this->hasMany(User_payment_method::class, 'payment_type_id');
    }
}
