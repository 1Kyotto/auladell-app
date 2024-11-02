<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Products\Product;

class OrderProduct extends Pivot
{
    use HasFactory;
    
    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'total_price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
