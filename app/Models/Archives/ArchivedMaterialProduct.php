<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materials\Material;

class ArchivedMaterialProduct extends Model
{
    protected $table = 'archived_material_product';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'material_id',
        'quantity',
        'archived_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'quantity' => 'decimal:2'
    ];

    public function archivedProduct()
    {
        return $this->belongsTo(ArchivedProduct::class, 'product_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}