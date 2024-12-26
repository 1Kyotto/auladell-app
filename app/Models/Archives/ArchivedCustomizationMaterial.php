<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customizations\CustomizationOption;
use App\Models\Materials\Material;

class ArchivedCustomizationMaterial extends Model
{
    protected $table = 'archived_customization_material';
    public $timestamps = false;

    protected $fillable = [
        'customization_option_id',
        'material_id',
        'product_id',
        'quantity_needed',
        'price_adjustment',
        'is_base',
        'archived_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'is_base' => 'boolean',
        'quantity_needed' => 'decimal:2',
        'price_adjustment' => 'decimal:2'
    ];

    public function archivedProduct()
    {
        return $this->belongsTo(ArchivedProduct::class, 'product_id');
    }

    public function customizationOption()
    {
        return $this->belongsTo(CustomizationOption::class, 'customization_option_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}