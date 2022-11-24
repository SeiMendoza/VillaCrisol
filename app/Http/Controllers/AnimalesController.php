<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Animal;
use Illuminate\Support\Facades\App as PDF;
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
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
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'animales')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);
        $view = View::make('Animal.Reporte_animal',compact('productos'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Reporte-animal-'.$text.'.pdf');
    }
    //pdf de animal
    public function animalespdf(){
        $productos= Producto::where('categoria','=','animales')->paginate(1000);
        $view = View::make('Animal.ReporteA',compact('productos'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Reporte-animales.pdf');
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
        return view('BuscarInventario/BuscarA', compact('productos', 'text')); 
    }

    public function createAnimal(){
        return view('Animal/registroAnimal');
    }

    public function storeAnimal(Request $request){
        
        /*Validación de campos*/
        $request -> validate([
            'tipo'=> 'required|min:3|max:50',
            'proposito' => 'required|in:producción,consumo',
            'descripcion' => 'required|min:3|max:100',
            'sexo' => 'required|in:macho,hembra',
            'raza' => 'required|min:3|max:100',
        ],
        [
            'tipo.required'=> 'El tipo es obligatorio',
            'tipo.min'=> 'El tipo requiere una longitud mínima de 3',
            'tipo.max'=> 'El tipo requiere una longitud máxima de 50',

            'proposito.required'=> 'El proposito es obligatorio',
            'proposito.min'=> 'El proposito requiere una longitud mínima de 3',
            'proposito.max'=> 'El proposito requiere una longitud máxima de 50',

            'descripcion.required'=> 'La descripcion es obligatorio',
            'descripcion.min'=> 'La descripcion requiere una longitud mínima de 3',
            'descripcion.max'=> 'La descripcion requiere una longitud máxima de 100',

            'nacimiento.required'=> 'La fecha de nacimiento es obligatorio',

            'raza.required'=> 'La raza es obligatorio',
            'raza.min'=> 'La raza requiere una longitud mínima de 3',
            'raza.max'=> 'La raza requiere una longitud máxima de 50',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $animal = new Animal();
         $animal->tipo=$request->input('tipo');
         $animal->proposito=$request->input('proposito');
         $animal->descripcion=$request->input('descripcion');
         $animal->sexo=$request->input('sexo');
         $animal->raza=$request->input('raza');


         /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
         $creado = $animal->save();
         if($creado){
             return redirect()->route('index')->with('mensaje', "El animal se registró correctamente");
         }
    }
}
