<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ordered_product_id',
        'rating_value',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order_line()
    {
        return $this->belongsTo(Order_line::class, 'ordered_product_id');
    }
}
