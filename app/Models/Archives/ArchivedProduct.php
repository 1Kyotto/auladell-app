<?php

namespace App\Models\Archives;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class ArchivedProduct extends Model
{
    protected $table = 'archived_products';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'raw_price',
        'final_price',
        'labor_hours',
        'labor_cost_per_hour',
        'category',
        'is_active',
        'image',
        'archived_at',
        'archived_by',
        'archive_reason',
        'original_created_at',
        'original_updated_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'original_created_at' => 'datetime',
        'original_updated_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }

    public function archivedCustomizations()
    {
        return $this->hasMany(ArchivedCustomizationProduct::class, 'product_id');
    }

    public function archivedCustomizationMaterials()
    {
        return $this->hasMany(ArchivedCustomizationMaterial::class, 'product_id');
    }

    public function archivedMaterials()
    {
        return $this->hasMany(ArchivedMaterialProduct::class, 'product_id');
    }

    public function archivedOrders()
    {
        return $this->hasMany(ArchivedOrderProduct::class, 'product_id');
    }
}