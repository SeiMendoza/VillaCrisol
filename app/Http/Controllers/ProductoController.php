<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.\s\-]+$/u|min:5|max:150'
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

    // ----------------------------------Restaurante----------------------------------------- //

    //Lista de productos
    public function indexRestaurante(){
        $productos= Producto::where('categoria', '=', 'restaurante')->paginate(10);
        return view ('productos/restaurante/inventarioRestaurante')->with('productos', $productos);
    }

    //buscar clientes
    public function searchRestaurante(Request $request){
        $text =trim($request->get('busqueda'));
        $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'restaurante')->paginate(10);
        return view('productos/restaurante/inventarioRestaurante', compact('productos', 'text'));
    }

    //función para ver productos
    public function showRestaurante($id){
        $producto = Producto::findOrfail($id);
        return view ('productos/restaurante/detalleRestaurante')->with('producto', $producto);
    }

}
