<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use App\Models\Materials\Material;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'additional_cost'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
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
}
