<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
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
    //pdf de siembra
    public function siembrapdf(Request $request){
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'siembras')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);
        $vista = view('piscina.Reporte_siembra')->with('productos',$productos);
$options = new Options();
$options->set('isRemoteEnabled', TRUE);

$dompdf = new Dompdf($options);
    // Definimos el tamaño y orientación del papel que queremos.
    $dompdf->setPaper('A4', 'portrait');
    // Cargamos el contenido HTML.
    $dompdf->loadHtml(utf8_decode($vista));
    // Renderizamos el documento PDF.
    $dompdf->render();
    // Enviamos el fichero PDF al navegador.
  $dompdf->stream("Reporte-siembra_".$text.".pdf");   
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
}
