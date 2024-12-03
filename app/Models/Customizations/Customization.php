<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use App\Models\Materials\Material;
use App\Models\Customizations\CustomizationSelection;
use App\Models\Customizations\CustomizationOption;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'customization_product', 'customization_id', 'product_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'customization_material', 'customization_option_id', 'material_id')
                    ->withPivot('quantity_needed', 'price_adjustment');
    }

    public function customizationSelections()
    {
        return $this->hasMany(CustomizationSelection::class);
    }

    public function customizationOptions()
    {
        return $this->hasMany(CustomizationOption::class);
    }
}
