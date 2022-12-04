<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalDetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'compra_id',
        'animal_id',
        'cantidad',
        'precioVenta',
        'precioCompra',
        'created_at',
        'updated_at'
    ];

    public function compra()
    {
        return $this->belongsTo(AnimalCompra::class);
    }

    public function animales()
    {
        return $this->belongsTo(Animal::class);
    }
}
