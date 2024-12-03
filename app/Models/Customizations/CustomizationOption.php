<?php

namespace App\Models\Customizations;

use App\Models\Materials\CustomizationMaterial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizationOption extends Model
{
    use HasFactory;

    protected $table = 'customization_option';
    protected $fillable = ['customization_id', 'option_name', 'requires_material'];
    public $timestamps = false;

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }

    public function customizationMaterials()
    {
        return $this->hasMany(CustomizationMaterial::class, 'customization_option_id');
    }
}
