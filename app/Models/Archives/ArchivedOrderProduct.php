<?php

namespace App\Models\Archives;

use Illuminate\Database\Eloquent\Model;
use App\Models\Orders\Order;

class ArchivedOrderProduct extends Model
{
    protected $table = 'archived_order_product';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'archived_at'
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    public function archivedProduct()
    {
        return $this->belongsTo(ArchivedProduct::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}