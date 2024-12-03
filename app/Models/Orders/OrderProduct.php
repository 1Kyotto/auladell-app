<?php

namespace App\Models\Orders;

use App\Models\Customizations\CustomizationSelection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Pivot
{
    use HasFactory;

    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'total_price'];
    public $timestamps = false;

    // Necesitamos que el pivot sea tratado como un modelo
    public $incrementing = true;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customizationSelections()
    {
        return $this->hasMany(CustomizationSelection::class, 'order_product_id');
    }
}
