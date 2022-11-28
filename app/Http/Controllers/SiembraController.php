<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Dompdf\Options;
use Dompdf\Dompdf;
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
    public function siembraspdf(){
        $productos= Producto::where('categoria','=','siembras')->paginate(1000);
        $view = View::make('Siembra.ReporteS',compact('productos'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Reporte-siembras.pdf');
    }
    //pdf de siembra
    public function siembrapdf(Request $request){
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'siembras')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);
        $vista = view('Siembra.Reporte_siembra')->with('productos',$productos);
        $view = View::make('Siembra.Reporte_siembra',compact('productos'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Reporte-siembra-'.$text.'.pdf'); 
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
        return view('BuscarInventario/BuscarS', compact('productos', 'text'));         
    }
    // detalle de siembras
    public function showSiembra($id){
        $producto = Producto::findOrfail($id);
        $producto->detalle_compra;
        $detalles = DetalleCompra::all();
        $detalle = DetalleCompra::findOrFail($id);
        $compra = Compra::findOrFail($id);
        return view ('Siembra/detalleSiembra')->with('producto', $producto)
        ->with('detalles', $detalles)
        ->with('detalle', $detalle)
        ->with('compra', $compra);
    }
}
