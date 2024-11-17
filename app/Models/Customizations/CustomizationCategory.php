<?php

namespace App\Models\Customizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customizations\CustomizationHierarchy;

class CustomizationCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'customization_hierarchy_id',
        'category',
    ];

    public function customizationHierarchy()
    {
        return $this->belongsTo(CustomizationHierarchy::class);
    }
}
