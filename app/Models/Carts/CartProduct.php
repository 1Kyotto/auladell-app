<?php

namespace App\Models\Carts;

use App\Models\Customizations\CustomizationSelection;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_product';
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function customizations()
    {
        return $this->hasMany(CustomizationSelection::class, 'cart_product_id');
    }
}
