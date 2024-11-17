<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customizations\Customization;

class CustomizationHierarchy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'customization_hierarchy';

    protected $fillable = [
        'name',
        'description',
        'customization_id',
        'parent_id',
        'additional_cost',
    ];

    // Relación con el modelo Customization
    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }

    // Relación para obtener la subpersonalización (hijos)
    public function children()
    {
        return $this->hasMany(CustomizationHierarchy::class, 'parent_id');
    }

    // Relación para obtener la personalización padre
    public function parent()
    {
        return $this->belongsTo(CustomizationHierarchy::class, 'parent_id');
    }

    // Relación de muchos a muchos con categorías
    public function categories()
    {
        return $this->hasMany(CustomizationCategory::class);
    }
}
