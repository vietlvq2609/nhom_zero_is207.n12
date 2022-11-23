<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email_address',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship With User_Address
    public function user_address()
    {
        return $this->hasMany(User_address::class, 'user_id');
    }
    public function shopping_cart()
    {
        return $this->hasMany(Shopping_cart::class, 'user_id');
    }
    public function user_review()
    {
        return $this->hasMany(User_review::class, 'user_id');
    }
    public function user_payment_method()
    {
        return $this->hasMany(User_payment_method::class, 'user_id');
    }
    public function user_role()
    {
        return $this->hasMany(User_role::class, 'user_id');
    }
}
