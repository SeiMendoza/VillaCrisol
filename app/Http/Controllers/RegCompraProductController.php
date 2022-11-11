<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\RcompraProducto;
use Illuminate\Http\Request;

class RegCompraProductController extends Controller
{

    public function index(){
        $compras = RcompraProducto::paginate(10);
        return view ('RegistroCompraProductos/CompraProductosIndex')->with('compras', $compras);
    }
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $compras = RcompraProducto::where('numfactura', 'like', '%'.$text.'%')
        ->orWhere('categoria', 'like', '%'.$text.'%')
        ->orWhere('fecha', 'like', '%'.$text.'%')->paginate(10);
        return view('RegistroCompraProductos/CompraProductosIndex', compact('compras', 'text'));
    }
    public function create(){
        $productos = Producto ::all();
        $detalles = DetalleCompra::all();
        $compra = RcompraProducto::all();
     return view ('RegistroCompraProductos.RegistroCompraProductos',compact('productos','detalles','compra'));
}

    public function detalle(Request $request){
        /*Validación de los campos*/

        $request ->validate([
            'producto'=>'required',
            'cantidad'=>'required|numeric',
            'precio'=>'required|numeric',
            'impuesto'=>'nullable|numeric',
        ],[
            'producto.required'=>'El producto es obligatorio',

            'cantidad.required'=>'La cantidad es obligatoria',
            'cantidad.numeric'=>'Solo se aceptan números',

            'precio.required'=>'El producto es obligatorio',
            'precio.numeric'=>'Solo se aceptan números',

            'impuesto.numeric'=>'Solo se aceptan números',
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

    //funcion para editar detalles
    public function detalleeditar(Request $request,$id){
        /*Validación de los campos*/

        $request ->validate([
            'producto'=>'required',
            'cantidad'=>'required|numeric|min:1',
            'precio'=>'required|numeric|min:1',
            'impuesto'=>'nullable|numeric|min:1',
        ],[
            'producto.required'=>'El producto es obligatorio',

            'cantidad.required'=>'La cantidad es obligatoria',
            'cantidad.numeric'=>'Solo se aceptan números',
            'cantidad.min'=>'Solo se aceptan números positivos',

            'precio.required'=>'El producto es obligatorio',
            'precio.numeric'=>'Solo se aceptan números',
            'precio.min'=>'Solo se aceptan números positivos',

            'impuesto.numeric'=>'Solo se aceptan números',
            'impuesto.min'=>'Solo se aceptan números positivos',
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $detalles = DetalleCompra::findOrFail($id);
        $detalles->producto_id=$request->input('producto');
        $detalles->cantidad=$request->input('cantidad');
        $detalles->precio=$request->input('precio');
        $detalles->impuesto=$request->input('imp');

        $creado = $detalles->save();

        if($creado){
        return redirect()->route('regcompra.create');
        }
    }

     //Funcion para guardar//
     public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'numfactura'=>'nullable|numeric|min:11',
            'impuesto'=>'nullable|numeric',
            'proveedor'=>'nullable|regex:/^[\pLñÑ.\s\-]+$/u',
            'descripción'=>'required|regex:/^[\pLñÑ0-9;:(),.\s\-]+$/u',
            'categoria'=>'required|in:restaurante,piscina,siembra,animales',
            'fecha'=>'required|date',
            'total'=>'required|numeric'
            ],[
                 
                'numfactura.numeric'=>'Solo se aceptan números',
                'numfactura.min'=>'El número de factura deben ser 11 digitos',
                'impuesto.numeric'=>'Solo se aceptan números',
                'proveedor.regex'=>'Solo se aceptan letras',
                'descripción.required'=>'La descripción es obligatoria',
                'descripción.regex'=>'La descripción tiene un caracter no permitido',
                'categoria.required'=>'La categoría es obligatoria',
                'categoria.regex'=>'La categoría tiene un caracter no permitido',
                'fecha.required'=>'La fecha es obligatoria',
                'fecha.date'=>'fecha incorrecta',
                'total.required'=>'El total es obligatorio',
                'total.numeric'=>'Solo se aceptan números'
            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevorcompraproducto = new RcompraProducto();
            $nuevorcompraproducto->numfactura=$request->input('numfactura');
            $nuevorcompraproducto->proveedor=$request->input('proveedor');
            $nuevorcompraproducto->descripción=$request->input('descripción');
            $nuevorcompraproducto->categoria=$request->input('categoria');
            $nuevorcompraproducto->fecha=$request->input('fecha');
            $nuevorcompraproducto->total=$request->input('total');
            $nuevorcompraproducto->impuesto=$request->input('impuesto');
            /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
            $creado = $nuevorcompraproducto->save();
            if($creado){
                return redirect()->route('regcompra.index')->with('mensaje', "Se registró correctamente la compra");
        }
   }
   public function destroy($id) {

DetalleCompra::destroy($id);

        return redirect()->route('regcompra.create')->with('mensaje','Detalle de compra borrado completamente');
    }

}
