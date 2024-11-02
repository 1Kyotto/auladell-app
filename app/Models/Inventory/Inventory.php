<?php

namespace App\Models\Inventories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materials\Material;
use App\Models\Auth\User;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'performed_by', 'quantity', 'transaction_type', 'date'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
