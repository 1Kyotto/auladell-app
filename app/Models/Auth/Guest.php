<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carts\Cart;
use App\Models\ShippingAddresses\ShippingAddress;
use App\Models\Orders\Order;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
