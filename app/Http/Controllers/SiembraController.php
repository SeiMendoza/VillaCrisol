<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\DB;

class SiembraController extends Controller
{
        //Lista de productos de siembra
    public function index(){
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'siembras')
        ->groupby('producto_id')
        ->paginate(10);
        return view ('Siembra/inventariosiembra')->with('productos', $productos);
    }
    //pdf de siembra
    public function siembrapdf(Request $request){
        
    }
    //buscar productos siembra
    public function searchSiembra(Request $request){
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'siembras')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);
        return view('Siembra/inventariosiembra', compact('productos', 'text')); 
        
        
    }
}
