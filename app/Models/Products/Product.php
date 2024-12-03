<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customizations\Customization;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
use App\Models\Customizations\CustomizationSelection;
use App\Models\Materials\CustomizationMaterial;
use App\Models\Materials\Material;
use App\Models\Materials\MaterialProduct;
use App\Models\Orders\Order;
use App\Models\Orders\OrderProduct;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'raw_price',
        'final_price',
        'labor_hours',
        'labor_cost_per_hour',
        'category', 
        'is_active', 
        'image',
    ];

    public function customizations()
    {
        return $this->belongsToMany(Customization::class, 'customization_product', 'product_id', 'customization_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_product')->withPivot('quantity_needed');
        //->withTimestamps();
    }

    public function customizationMaterials()
    {
        return $this->hasMany(CustomizationMaterial::class);
    }

    public function customizationSelections()
    {
        return $this->hasManyThrough(CustomizationSelection::class, OrderProduct::class, 'product_id', 'order_product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->using(OrderProduct::class)->withPivot('quantity', 'unit_price', 'total_price');
    }
}
