<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Auth\Guest;
use App\Models\ShippingAddresses\ShippingAddress;
use App\Models\Products\Product;
use App\Models\Orders\OrderProduct;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'guest_id', 'shipping_address_id', 'total', 'status', 'order_num'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->using(OrderProduct::class)
                    ->withPivot(['quantity', 'unit_price', 'total_price'])
                    ->as('order_product');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
