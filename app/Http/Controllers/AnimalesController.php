<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\DB;

class AnimalesController extends Controller
{
     //Lista de productos de animal
     public function index(){
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'animales')
        ->groupby('producto_id')
        ->paginate(10);
        return view ('Animal/inventarioanimal')->with('productos', $productos);
    }
    //pdf de animal
    public function animalpdf(Request $request){

    }
    //buscar productos animal
    public function searchanimal(Request $request){
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'animales')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);
        return view('Animal/inventarioanimal', compact('productos', 'text')); 
        
        
    }
}
