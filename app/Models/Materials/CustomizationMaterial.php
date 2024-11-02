<?php

namespace App\Models\Materials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Customizations\Customization;

class CustomizationMaterial extends Pivot
{
    use HasFactory;

    protected $table = 'customization_material';
    protected $fillable = ['customization_id', 'material_id', 'quantity_needed'];

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
