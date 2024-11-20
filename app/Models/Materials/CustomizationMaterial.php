<?php

namespace App\Models\Materials;

use App\Models\Customizations\Customization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Customizations\CustomizationHierarchy;
use App\Models\Products\Product;

class CustomizationMaterial extends Pivot
{
    use HasFactory;

    protected $table = 'customization_material';
    protected $fillable = ['product_id', 'customization_id', 'material_id', 'price_adjustment'];
    public $timestamps = false;

    public function customization()
    {
        return $this->belongsTo(Customization::class, 'customization_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
