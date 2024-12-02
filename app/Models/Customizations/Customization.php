<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use App\Models\Materials\Material;
use App\Models\Customizations\CustomizationHierarchy;
use App\Models\Customizations\CustomizationSelection;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'customization_product', 'customization_id', 'product_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot('quantity_needed');
        //->withTimestamps();
    }

    public function customizationSelections()
    {
        return $this->hasMany(CustomizationSelection::class);
    }

    public function options()
    {
        return $this->hasMany(CustomizationOption::class);
    }
}
