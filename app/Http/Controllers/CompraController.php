<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // Lista de compras
    public function index(Request $request)
    {
        $compras = Compra::paginate(10);
        return view('compras.listaCompra', compact('compras'));
    }

    //buscar compras
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $compras = Compra::where('nombreCompra', 'like', '%'.$text.'%')->paginate(10);
        return view('compras/listaCompra')->with('compras', $compras);
    }


    //crear nueva compra
    public function create()
    {
        return view('compras.registroCompra');
    }

    public function store(Request $request){
        $request ->validate([
            'numeroFactura'=>'numeric|unique:compras|min:0',
            'nombreCompra' => 'required|string|min:5|max:80',
            'fecha' => 'required',
            'cantidad' =>  'required|numeric|min:0',
            'precio'=>  'required|numeric|min:0',
            'total'=>  'required|numeric|min:0',
        ],[

            'numeroFactura.numeric' => 'Solo se permiten números',
            'numeroFactura.unique' => 'Los datos ingresados deben ser únicos',
            'numeroFactura.min' => 'Ingresar mínimo un dígito',

            'nombreCompra.required' => 'Campo obligatorio, ingresar nombre de la compra',
            'nombreCompra.string' => 'Se debe registrar un nombre para la compra',
            'nombreCompra.min' => 'Ingresar un mínimo de 5 letras',
            'nombreCompra.max' => 'Se ha excedido el limite máximo de 80 letras',

            'fecha.required' => 'Se tiene que ingresar una fecha',

            'cantidad.required' => 'Campo obligatorio, ingresar una cantidad',
            'cantidad.numeric' => 'Solo se permiten números',
            'cantidad.min' => 'La cantidad mínima a ingresar es "0"',

            'precio.required' => 'Campo obligatorio, ingresar un precio',
            'precio.numeric' => 'Solo se permiten números',
            'precio.min' => 'La cantidad mínima a ingresar es "0"',

            'total.required' => 'Campo obligatorio, ingresar el total',
            'total.numeric' => 'Solo se permiten números',
            'total.min' => 'La cantidad mínima a ingresar es "0"',
        ]);

        $crearCompra = new Compra();

        $crearCompra->numeroFactura = $request->input('numeroFactura');
        $crearCompra->nombreCompra = $request->input('nombreCompra');
        $crearCompra->fecha = $request->input('fecha');
        $crearCompra->cantidad = $request->input('cantidad');
        $crearCompra->precio = $request->input('precio');
        $crearCompra->total = $request->input('total');
        $crearCompra->observacion = $request->input('observacion');
        //$crearCompra->imagenFactura = $request->input('imagenFactura');
        //$crearCompra->fechaRegistro = now()->format('Y-m-d');
        //$crearCompra->usuario = "Admin";
        if($request->hasFile('imagenFactura')){
            $imagen = $request->file('imagenFactura');
            $extention = $imagen->getClientOriginalExtension();
            $filname = time().'.'.$extention;
            $imagen->move('imagenes/', $filname);
            $crearCompra->imagen_producto = $filname;
        }

        $create = $crearCompra->save();

        if($create){
            return redirect()->route('compras.index')
            ->with('mensaje','La compra fue registrada exitosamente.');
        }
        else{
            //
        }
    }

    //ver detalle de la compra
    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return view('compras.detallesCompra', compact('compra'));
    }
}
