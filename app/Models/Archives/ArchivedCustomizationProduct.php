<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customizations\Customization;

class ArchivedCustomizationProduct extends Model
{
    protected $table = 'archived_customization_product';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'customization_id',
        'archived_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime'
    ];

    public function archivedProduct()
    {
        return $this->belongsTo(ArchivedProduct::class, 'product_id');
    }

    public function customization()
    {
        return $this->belongsTo(Customization::class, 'customization_id');
    }
}