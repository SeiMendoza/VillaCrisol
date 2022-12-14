<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Animal;
use App\Models\Compra;
use App\Models\DetalleCompra;
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
        $productos= Producto::where('categoria', '=', 'animales')->paginate(10);
        return view ('Animal/inventarioanimal')->with('productos', $productos);
    }
    //mostrar detalles de producto de animal
    public function showAnimal($id){
        $producto = Producto::findOrfail($id);
        $producto->detalle_compra;
        $detalles = DetalleCompra::all();
        $detalle = DetalleCompra::findOrFail($id);
        $compra = Compra::findOrFail($id);
        return view ('Animal/detalleAnimal')->with('producto', $producto)
        ->with('detalles', $detalles)
        ->with('detalle', $detalle)
        ->with('compra', $compra);
    }
    //pdf de animal
    public function animalpdf(Request $request){
        $text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'animales')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(1000);
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
        /*$text =trim($request->get('busqueda'));
        $productos= Producto::select('producto_id', 'productos.nombre',DB::raw('sum(cantidad) as existencia'), 'productos.precio')
        ->join('detalle_compras','productos.id','=','detalle_compras.producto_id')
        ->where('categoria', '=', 'animales')
        ->where('nombre', 'like', '%'.$text.'%')
        ->groupby('producto_id')
        ->paginate(10);*/
        $text =trim($request->get('busqueda'));
        $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'animales')->paginate(10);
        return view('BuscarInventario/BuscarA', compact('productos', 'text')); 
    }

    public function createAnimal(){
        return view('Animal/registroAnimal');
    }

    public function storeAnimal(Request $request){
        
        /*Validaci??n de campos*/
        $request -> validate([
            'tipo'=> 'required|min:3|max:50',
            'proposito' => 'required|in:producci??n,consumo,dom??stico',
            'descripcion' => 'required|min:3|max:100',
            'sexo' => 'required|in:macho,hembra',
            'raza' => 'required|min:3|max:100',
        ],
        [
            'tipo.required'=> 'El tipo de animal es obligatorio',
            'tipo.min'=> 'El tipo de animal requiere una longitud m??nima de 3',
            'tipo.max'=> 'El tipo de animal requiere una longitud m??xima de 50',

            'proposito.required'=> 'El prop??sito es obligatorio',
            'proposito.min'=> 'El prop??sito requiere una longitud m??nima de 3',
            'proposito.max'=> 'El prop??sito requiere una longitud m??xima de 50',

            'descripcion.required'=> 'La descripci??n es obligatorio',
            'descripcion.min'=> 'La descripci??n requiere una longitud m??nima de 3',
            'descripcion.max'=> 'La descripci??n requiere una longitud m??xima de 100',

            'nacimiento.required'=> 'La fecha de nacimiento es obligatorio',

            'raza.required'=> 'La raza es obligatorio',
            'raza.min'=> 'La raza requiere una longitud m??nima de 3',
            'raza.max'=> 'La raza requiere una longitud m??xima de 50',
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
             return redirect()->route('index')->with('mensaje', "El animal se registr?? correctamente");
         }
    }
    // Editar animal
    public function editAnimal ($id){
        $animal = Animal::findOrfail($id);
        return view('Animal.editarAnimal')->with('animal',$animal);
    }
    // actualizar animal
    public function updateAnimal(Request $request, $id){

        //$animal = Animal::findOrFail($id);
        /*Validaci??n de campos*/
        $request -> validate([
            'tipo'=> 'required|min:3|max:50',
            'proposito' => 'required|in:producci??n,consumo,dom??stico',
            'descripcion' => 'required|min:3|max:100',
            'sexo' => 'required|in:macho,hembra',
            'raza' => 'required|min:3|max:100',
        ],
        [
            'tipo.required'=> 'El tipo de animal es obligatorio',
            'tipo.min'=> 'El tipo de animal requiere una longitud m??nima de 3',
            'tipo.max'=> 'El tipo de animal requiere una longitud m??xima de 50',

            'proposito.required'=> 'El prop??sito es obligatorio',
            'proposito.min'=> 'El prop??sito requiere una longitud m??nima de 3',
            'proposito.max'=> 'El prop??sito requiere una longitud m??xima de 50',

            'descripcion.required'=> 'La descripci??n es obligatorio',
            'descripcion.min'=> 'La descripci??n requiere una longitud m??nima de 3',
            'descripcion.max'=> 'La descripci??n requiere una longitud m??xima de 100',

            'nacimiento.required'=> 'La fecha de nacimiento es obligatorio',

            'raza.required'=> 'La raza es obligatorio',
            'raza.min'=> 'La raza requiere una longitud m??nima de 3',
            'raza.max'=> 'La raza requiere una longitud m??xima de 50',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $animal = Animal::findOrFail($id); 
         $animal->tipo=$request->input('tipo');
         $animal->proposito=$request->input('proposito');
         $animal->descripcion=$request->input('descripcion');
         $animal->sexo=$request->input('sexo');
         $animal->raza=$request->input('raza');
        
         $creado = $animal->save();
    if($creado){
        return redirect()->route('index')->with('mensaje', "El animal se actualizo correctamente");
    }
    }
}
