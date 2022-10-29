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
            ],[
            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevorcompraproducto = new RcompraProducto();
         
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
