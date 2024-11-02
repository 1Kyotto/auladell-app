<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\OrderProduct;

class CustomizationSelection extends Model
{
    use HasFactory;

    protected $table = 'customization_selection';
    protected $fillable = ['order_product_id', 'customization_id', 'quantity'];

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
