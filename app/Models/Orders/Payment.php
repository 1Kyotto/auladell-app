<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'payment_method', 'total_price', 'net_price', 'payment_status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
