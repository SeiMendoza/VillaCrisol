<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\RcompraProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    //funcion para crear un nuevo producto
    public function createProducto(){
        return view('productos.registroProducto');
    }

    //funcion para validar y guardar el nuevo producto
    public function storeProducto(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/|min:3|max:50',
            'categoria' => 'required|in:restaurante,piscina,siembras,animales',
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.;:(),\s\-]+$/u|min:5|max:150'
        ],
        [
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.regex'=> 'El nombre tiene un caracter no valido',
            'nombre.min'=> 'El nombre requiere una longitud mínima de 3',
            'nombre.max'=> 'El nombre requiere una longitud máxima de 50',

            'categoria.required' =>'La categoría es obligatoria',

            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no valido',
            'descripcion.min'=>'La descripción requiere una longitud mínima de 5',
            'descripcion.max'=>'La descripción requiere una longitud máxima de 150',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $nuevoProducto = new Producto();
         $nuevoProducto->nombre=$request->input('nombre');
         $nuevoProducto->descripcion=$request->input('descripcion');
         $nuevoProducto->categoria=$request->input('categoria');

         /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
         $creado = $nuevoProducto->save();
         if($creado){
             return redirect()->route('index')->with('mensaje', "El producto se registró correctamente");
         }
    }

    // editar productos
    public function edit($id){
        $producto = Producto::findOrFail($id);
        return view('productos/editarProducto', compact('producto'));
    }

    public function update(Request $request, $id){

        /*Validación de campos*/
        $request -> validate([
            'nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/|min:3|max:50',
            'categoria' => 'required|in:restaurante,piscina,siembras,animales',
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.;:(),\s\-]+$/u|min:5|max:150'
        ],
        [
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.regex'=> 'El nombre tiene un caracter no valido',
            'nombre.min'=> 'El nombre requiere una longitud mínima de 3',
            'nombre.max'=> 'El nombre requiere una longitud máxima de 50',

            'categoria.required' =>'La categoría es obligatoria',

            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no valido',
            'descripcion.min'=>'La descripción requiere una longitud mínima de 5',
            'descripcion.max'=>'La descripción requiere una longitud máxima de 150',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $producto = Producto::findOrFail($id);
         $producto->nombre=$request->input('nombre');
         $producto->descripcion=$request->input('descripcion');
         $producto->categoria=$request->input('categoria');

         /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
         $creado = $producto->save();
         if($creado){
             return redirect()->route('inventario.index')->with('mensaje', "El producto se actualizó correctamente");
         }
    }



    // ----------------------------------Restaurante----------------------------------------- //

    //Lista de productos
    public function index(){
        $productos= Producto::where('categoria', '=', 'restaurante')->paginate(10);
        return view ('productos/inventarios')->with('productos', $productos);
    }

    //buscar productos
    public function searchRestaurante(Request $request){
        $text =trim($request->get('busqueda'));
        $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'restaurante')->paginate(10);
        return view('productos/inventarios', compact('productos', 'text'));
    }

    //función para ver productos
    public function showRestaurante($id){
        $producto = Producto::findOrfail($id);
        $producto->detalle_compra;
        $detalles = DetalleCompra::all();
        $detalle = DetalleCompra::findOrFail($id);
        $compra = Compra::findOrFail($id);
        return view ('productos/detalleRestaurante')->with('producto', $producto)
        ->with('detalles', $detalles)
        ->with('detalle', $detalle)
        ->with('compra', $compra);
    }
//Lista de productos de piscina
public function piscinaindex(){
    $productos= Producto::where('categoria', '=', 'piscina')->paginate(10);
    return view ('piscina/invpiscina')->with('productos', $productos);
}

//buscar productos
public function searchPiscina(Request $request){
    $text =trim($request->get('busqueda'));
    $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'piscina')->paginate(10);
    return view('piscina/invpiscina', compact('productos', 'text'));
}
}
