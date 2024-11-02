<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Products\Product;

class MaterialProduct extends Pivot
{
    use HasFactory;

    protected $table = 'material_product';
    protected $fillable = ['material_id', 'product_id', 'quantity_needed'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
