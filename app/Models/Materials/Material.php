<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Product;
use App\Models\Customizations\Customization;
use App\Models\Inventories\Inventory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'unit', 'price_per_unit', 'quantity_in_stock'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity_needed');
        //->withTimestamps();
    }

    public function customizations()
    {
        return $this->belongsToMany(Customization::class)->withPivot('quantity_needed');
        //->withTimestamps();
    }

    public function inventoryChanges()
    {
        return $this->hasMany(Inventory::class);
    }
}
