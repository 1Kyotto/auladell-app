<?php

namespace App\Models\Carts;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Products\Product;

class CartProduct extends Pivot
{
    protected $table = 'cart_product';
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
