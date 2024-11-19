<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Customizations\CustomizationHierarchy;

class CustomizationMaterial extends Pivot
{
    use HasFactory;

    protected $table = 'customization_material';
    protected $fillable = ['customization_hierarchy_id', 'material_id', 'quantity_needed'];

    public function customization()
    {
        return $this->belongsTo(CustomizationHierarchy::class, 'customization_hierarchy_id'); // Ajusta la columna
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
