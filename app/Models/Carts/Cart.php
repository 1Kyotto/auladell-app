<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Auth\Guest;
use App\Models\Products\Product;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(CartProduct::class)->withPivot('quantity', 'price');
        //->withTimestamps(); Quizás
    }
}
