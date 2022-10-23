<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_cart extends Model
{
    use HasFactory;

    // Relationships 
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shopping_cart_item()
    {
        return $this->hasMany(Shopping_cart_item::class, 'cart_id');
    }
}
