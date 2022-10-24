<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroController extends Controller
{

    //funcion para crear un nuevo producto
    public function createProducto(){
        return view('registros.registroProducto');
    }

    //funcion para validar y guardar el nuevo producto
    public function storeProducto(Request $request){

        $request -> validate([
            'nombreProducto'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/|min:3|max:50',
            'categoria' => 'required|in:restaurante,piscina,siembras,animales',
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.\s\-]+$/u|min:5|max:100'
        ],
        [
            'nombreProducto.required'=> 'El nombre es obligatorio',
            'nombreProducto.regex'=> 'El nombre tiene un caracter no valido',
            'nombreProducto.min'=> 'El nombre requiere una longitud mínima de 3',
            'nombreProducto.max'=> 'El nombre requiere una longitud máxima de 50',

            'categoria.required' =>'La categoría es obligatoria',

            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no valido',
            'descripcion.min'=>'La descripción requiere una longitud mínima de 5',
            'descripcion.max'=>'La descripción requiere una longitud máxima de 100',
        ]);

        return redirect()->route('producto.create')->with('mensaje', "El producto se registró correctamente");
    }
}
