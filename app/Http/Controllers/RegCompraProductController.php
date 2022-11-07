<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\RcompraProducto;
use Illuminate\Http\Request;

class RegCompraProductController extends Controller
{
    public function create(){
        $productos = Producto::all();
        return view ('RegistroCompraProductos.RegistroCompraProductos')
        ->with('productos', $productos);
    }

    public function detalle(Request $request){
        /*Validación de los campos*/

        $request ->validate([
            'producto'=>'required',
            'cantidad'=>'required|numeric',
            'precio'=>'required|numeric',
            //'impuesto'=>'nullable|numeric',
        ],[
            'producto.required'=>'El producto es obligatorio',

            'cantidad.required'=>'La cantidad es obligatoria',
            'cantidad.numeric'=>'Solo se aceptan números',

            'precio.required'=>'El producto es obligatorio',
            'precio.numeric'=>'Solo se aceptan números',

            //'impuesto.numeric'=>'Solo se aceptan números',
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $detalles = new DetalleCompra();
        $detalles->compra_id= "1";
        $detalles->producto_id=$request->input('producto');
        $detalles->cantidad=$request->input('cantidad');
        $detalles->precio=$request->input('precio');

        $creado = $detalles->save();

        if($creado){
        return redirect()->route('regcompra.create');
        }
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
