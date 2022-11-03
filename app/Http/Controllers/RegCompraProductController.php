<?php

namespace App\Http\Controllers;

use App\Models\RcompraProducto;
use Illuminate\Http\Request;

class RegCompraProductController extends Controller
{
    public function create(){
        return view ('RegistroCompraProductos.RegistroCompraProductos');
     }

     //Funcion para guardar el nuevo menu agregado mediante el formulario//
     public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'numfactura'=>'required|numeric', 
            'impuesto'=>'nullable|numeric',
            'proveedor'=>'nullable|regex:/^[\pLñÑ.\s\-]+$/u',
            'descripción'=>'required|regex:/^[\pLñÑ0-9;:(),.\s\-]+$/u', 
            'categoria'=>'required|in:restaurante,piscina,siembra,animales',
            'fecha'=>'required|date',
            'total'=>'required|numeric'
            ],[
                'numfactura.required'=>'El codigo de factura es obligatorio',
                'numfactura.numeric'=>'Solo se aceptan numeros',
                'impuesto.numeric'=>'Solo se aceptan numeros',
                'proveedor.regex'=>'Solo se aceptan letras',
                'descripción.required'=>'La descripción es obligatoria',
                'descripción.regex'=>'La descripción tiene un caracter no permitido',
                'fecha.required'=>'La fecha es obligatoria',
                'fecha.date'=>'fecha incorrecta',
                'total.required'=>'El total es obligatorio',
                'total.numeric'=>'Solo se aceptan numeros' 
            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevorcompraproducto = new RcompraProducto();
            $nuevorcompraproducto->numfactura=$request->input('numfactura');
            $nuevorcompraproducto->proveedor=$request->input('proveedor');
            $nuevorcompraproducto->descripción=$request->input('descripción');
            $nuevorcompraproducto->fecha=$request->input('fecha');
            $nuevorcompraproducto->total=$request->input('total');
            $nuevorcompraproducto->impuesto=$request->input('impuesto');
            /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
            $creado = $nuevorcompraproducto->save();
            if($creado){
                return redirect()->route('')->with('mensaje', "Se registró correctamente la compra");
        }
   }
   public function destroy($id) {
    RcompraProducto::destroy($id);
        //redirigir 
        return redirect('//')->with('mensaje','Compra borrada completamente');
    }
}
