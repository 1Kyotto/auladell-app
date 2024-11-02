<?php

namespace App\Models\ShippingAddresses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\Auth\Guest;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'guest_id', 'city', 'locality', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
