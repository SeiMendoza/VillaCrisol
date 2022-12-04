<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegCompraProductController extends Controller
{

    public function index(){
        $compras = Compra::paginate(10);
        $comp = Compra::select(DB::raw('min(fecha) as inicio, max(fecha) as final'))->first();
        $inicio = $comp->inicio;
        $final = $comp->final;
        return view ('RegistroCompraProductos/CompraProductosIndex')->with('compras', $compras)->with('inicio', $inicio)->with('final', $final);
    }
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $inicio =trim($request->get('inicio'));
        $final =trim($request->get('final'));
        $compras = Compra::whereBetween('fecha', [$inicio, $final])
        ->where(function($q) use ($text){
            $q->where('numfactura', 'like', '%'.$text.'%')
            ->orWhere('categoria', 'like', '%'.$text.'%');
         })
        ->paginate(10);


        return view('RegistroCompraProductos/CompraProductosIndex', compact('compras', 'text','inicio','final'));
    }
    public function create(){
        $productos = Producto::all();
        $detalles = Detallecompra::all();
        $compra = Compra::where('proveedor','=','')->get();
        if($compra->count() == 0){

            $compra_nueva = new Compra();
            $compra_nueva->numfactura = '';
            $compra_nueva->fecha = '2022-11-12';
            $compra_nueva->proveedor = '';
            $compra_nueva->categoria = '';
            $compra_nueva->descripción = '';
            $compra_nueva->save();
            return view('RegistroCompraProductos.RegistroCompraProductos')->with('compra', $compra_nueva)
                                                ->with('productos', $productos)
                                                ->with('detalles', $detalles);
        }
        return view('RegistroCompraProductos.RegistroCompraProductos')->with('compra', $compra[0])
                                                ->with('productos', $productos)
                                                ->with('detalles', $detalles);
    }

    public function buscarpro(Request $request){
        $busc =trim($request->get('buscar_producto'));
        $productos = Producto::Where('nombre', 'LIKE', '%'.$busc. '%')->paginate(5);
        return view('RegistroCompraProductos.RegistroCompraProductos', compact('productos', 'busc'));
    }


    //Funcion para guardar//
    public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'numfactura'=>'nullable|numeric|min:11',
            'proveedor'=>'nullable|regex:/^[\pLñÑ.\s\-]+$/u',
            'descripción'=>'required|regex:/^[\pLñÑ0-9;:(),.\s\-]+$/u',
            'fecha'=>'required|date',
            'tuplas'=>'required'
            ],[

                'numfactura.numeric'=>'Solo se aceptan números',
                'numfactura.min'=>'El número de factura deben ser 11 digitos',
                'proveedor.regex'=>'Solo se aceptan letras',
                'fecha.required'=>'La fecha es obligatoria',
                'fecha.date'=>'fecha incorrecta',
                'tuplas.required'=>'No hay detalles'
            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            //$nuevorcompraproducto = new RcompraProducto();
            $nuevorcompraproducto = Compra::findOrFail($request->input('compra_id'));
            $nuevorcompraproducto->numfactura=$request->input('numfactura');
            $nuevorcompraproducto->proveedor=$request->input('proveedor');
            $nuevorcompraproducto->descripción=$request->input('descripción');
            $nuevorcompraproducto->fecha=$request->input('fecha');
            $nuevorcompraproducto->save();

            for ($i=0; $i < intval($request->input("tuplas")) ; $i++) {
                //$array = explode ( ' ', $request->input("detalle-".$i) );
                $detalle= new DetalleCompra();
                $detalle->compra_id = $nuevorcompraproducto->id;
                $detalle->producto_id = $request->input('producto_id');
                $detalle->cantidad = $request->input('cantidad');
                $detalle->precio = $request->input('precio');
                $detalle->impuesto = $request->input('imp');
                $detalle->save();
            }

            return redirect()->route('regcompra.index')->with('mensaje','compra registrada');

    }


    public function detail($id){
        $detalles = Compra::findOrFail($id);

        return view ('RegistroCompraProductos/DetalleCompraProductos')->with('detalles', $detalles);
    }

}
