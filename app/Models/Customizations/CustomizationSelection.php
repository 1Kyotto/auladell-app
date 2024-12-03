<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\OrderProduct;
use App\Models\Customizations\CustomizationOption;

class CustomizationSelection extends Model
{
    use HasFactory;

    protected $table = 'customization_selection';
    protected $fillable = ['cart_product_id', 'order_product_id', 'customization_option_id', 'quantity'];

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function customizationOption()
    {
        return $this->belongsTo(CustomizationOption::class, 'customization_option_id');
    }
}
