<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\AnimalCompra;
use App\Models\AnimalDetalleCompra;
use App\Models\Compra;
use App\Models\compraAnimales;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraAnimalController extends Controller
{

   /* public function __construct()
    {
        session_start();
        parent::__construct();
    }*/
    public function inventario(){
        $animales= AnimalDetalleCompra::select(
            DB::raw('animal_id as id, animal_id, SUM(cantidad) AS cantidad, SUM(precioVenta*cantidad)/SUM(cantidad) AS precioVenta')
        )
        ->groupby('animal_id')
        ->paginate(10);
        return view ('animales/inventarioanimal')->with('animales', $animales);
    }

    public function inventariobuscar(Request $request){
        $text =trim($request->get('busqueda'));
        $animales= AnimalDetalleCompra::select(
            DB::raw('animal_id as id, animal_id, SUM(cantidad) AS cantidad, SUM(precioVenta*cantidad)/SUM(cantidad) AS precioVenta')
        )
        ->groupby('animal_id')
        ->where('tipo', 'like', '%'.$text.'%')
        ->orwhere('proposito', 'like', '%'.$text.'%')
        ->join('animals','animals.id','=','animal_detalle_compras.animal_id')->paginate(10);
        return view ('animales/inventarioanimal')->with('animales', $animales)->with('text', $text);
    }

    public function create(){
        $animales = Animal::all();
        $detalles = AnimalDetalleCompra::all();
        $compra = AnimalCompra::where('proveedor','=','')->get();
        if($compra->count() == 0){

            $compra_nueva = new AnimalCompra();
            $compra_nueva->proveedor = '';
            $compra_nueva->nacimiento = '2022-11-12';
            $compra_nueva->fecha = '2022-11-12';
            $compra_nueva->descripcion = '';
            $compra_nueva->save();
            return view('animales\registroCompraAnimales')->with('compra', $compra_nueva)
                                                ->with('animales', $animales)
                                                ->with('detalles', $detalles);
        }
        return view('animales\registroCompraAnimales')->with('compra', $compra[0])
                                                ->with('animales', $animales)
                                                ->with('detalles', $detalles);
    }

    public function buscarpro(Request $request){
        $busc =trim($request->get('buscar_animal'));
        $animales = Animal::Where('tipo', 'LIKE', '%'.$busc. '%')->paginate(5);
        return view('animales\registroCompraAnimales', compact('animales', 'busc'));
    }

    public function store(Request $request)
    {
        $request ->validate([
            'tuplas' => ['required'],
            'proveedor'=>'nullable|regex:/^[\pLñÑ.\s\-]+$/u',
            'nacimiento'=>'required|date',
            'fecha'=>'required|date',
            'descripcion'=>'required|regex:/^[\pLñÑ0-9;:(),.\s\-]+$/u',

        ],[
            'nacimiento.required'=>'La fecha es requerida',
            'proveedor.regex'=>'Solo se aceptan letras',
            'nacimiento.required'=>'La fecha de nacimiento es obligatoria',
            'nacimiento.date'=>'fecha incorrecta',
            'fecha.required'=>'La fecha es obligatoria',
            'fecha.date'=>'fecha incorrecta',
            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no permitido',
            'tuplas.required'=>'no hay detalles'

        ]);

        $nuevorcompra = new AnimalCompra();
        $nuevorcompra->proveedor=$request->input('proveedor');
        $nuevorcompra->nacimiento=$request->input('nacimiento');
        $nuevorcompra->fecha=$request->input('fecha');
        $nuevorcompra->descripcion=$request->input('descripcion');
        $nuevorcompra->save();


        for ($i=0; $i < intval($request->input("tuplas")) ; $i++) {
            $array = explode ( ' ', $request->input("detalle-".$i) );
            $detalle = new AnimalDetalleCompra();
            $detalle->compra_id = $nuevorcompra->id;
            $detalle->animal_id = $array[0];
            $detalle->cantidad = $array[1];
            $detalle->precioVenta = $array[2];
            $detalle->precioCompra =$array[3];
            $detalle->save();

        }


        /*foreach ($detalle as $key => $value) {
            $pro = Producto::findOrFail($value->producto_id);
            $pro->existencia = $value->cantidad + $pro->existencia;
            $pro->precio= $value->precio;
            $pro->save();
        }*/

        return redirect()->route('index');
    }

    public function show($id){
        $animales = Animal::find($id);
        return view ('animales/detalleinventarioanimal')->with('animal', $animales);
    }

    public function detalle($id){
        $animales = AnimalCompra::find($id);
        return view ('animales/detalleanimal')->with('animal', $animales);
    }

}
