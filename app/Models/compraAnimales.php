<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compraAnimales extends Model
{
    use HasFactory;
    protected $table = 'animal_compras';
    public function __construct()
    {
        parent::__construct();
    }

    public function detalle_compra()
    {
        return $this->hasMany(AnimalDetalleCompra::class);
    }
}
