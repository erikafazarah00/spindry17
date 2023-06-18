<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'discount', 
        'picture', 
        'status'
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'promo_id', 'id');
    }
}
