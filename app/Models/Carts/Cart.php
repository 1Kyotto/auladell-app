<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Auth\Guest;
use App\Models\Products\Product;
use App\Models\Carts\CartProduct;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'guest_id'];

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
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }
}
