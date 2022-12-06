<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCompra extends Model
{
    use HasFactory;

    public function detalle_compra()
    {
        return $this->hasMany(AnimalDetalleCompra::class,'compra_id');
    }
}
