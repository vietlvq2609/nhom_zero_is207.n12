<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount_rate',
        'start_date',
        'end_date'
    ];

    public function promotion_category()
    {
        return $this->hasMany(Promotion_category::class, "promotion_id");
    }
}
