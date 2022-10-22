<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class ClienteController extends Controller
{

    public function index(){
        $clientes= Cliente::paginate(10);
        return view ('clientes.listaClientes')->with('clientes', $clientes);
    }

    //buscar clientes
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $clientes = Cliente::where('nombreCompleto', 'like', '%'.$text.'%')
        ->orWhere('numeroId', 'like', '%'.$text.'%')->paginate(10);
        return view('clientes/listaClientes', compact('clientes', 'text'));
    }

    //Lista de clientes
    public function create(){
        return view ('clientes.registroClientes');
    }

    //Funcion para guardar el nuevo cliente
    public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'nombreCompleto'=> 'required|regex:/^[a-zA-Z\s\.]+$/|max:50|min:3',
            'numeroId'=> 'required|unique:clientes,numeroId|regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/|max:15|min:15',
            'correo'=>'required|regex:/(.+)@(.+)\.(.+)$/|min:12|max:50|unique:clientes',
            'numeroTelefono'=>['required', 'min:8', 'numeric', 'regex:/^[2,3,8,9][0-9]{7}+$/', 'unique:clientes,numeroTelefono'],
            'domicilio'=> 'required|regex:/^[a-zA-Z\0-9\s\.]+$/|min:4|max:50',
            ],[

            'nombreCompleto.required'=> 'El nombre es obligatorio',
            'nombreCompleto.regex'=> 'El nombre completo debe tener solo letras',
            'nombreCompleto.max'=> 'El nombre completo no puede exceder de 50 letras',
            'nombreCompleto.regex'=>'Solo se permiten letras',

            'numeroId.required'=> 'El número de identidad es obligatorio ',
            'numeroId.regex'=> 'El número De identidad debe iniciar con (0 o 1) separado por (-) ejemplo (####-####-#####)',
            'numeroId.unique'=> 'El número De identidad ya existe',

            'correo.required'=>'El correo es obligatorio',
            'correo.regex'=>'El correo es incorrecto ejemplo:(usuario@mail.com ó usuario@mail.es)' ,
            'correo.min'=>'La longitud minima del correo electronico es: 12' ,
            'correo.max'=>'La longitud maxima del correo electronico es: 50' ,
            'correo.unique'=>'El correo ingresado ya existe',

            'numeroTelefono.required'=>'El número telefónico es obligatorio',
            'numeroTelefono.min'=>'El número telefónico debe tener 8 dígitos',
            'numeroTelefono.numeric'=>'El número telefónico debe ser unicamente numérico',
            'numeroTelefono.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'numeroTelefono.unique'=>'El número telefónico ingresado ya existe',

            'domicilio.required'=> 'El domicilio es obligatorio' ,
            'domicilio.min'=> 'El domicilio debe tener minimo:4 letras' ,
            'domicilio.max'=> 'El domicilio debe tener maximo:50 letras' ,
            'domicilio.regex'=> 'Un caracter ingresado no es permitido'
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $nuevoCliente = new Cliente();
        $nuevoCliente->nombreCompleto=$request->input('nombreCompleto');
        $nuevoCliente->numeroId=$request->input('numeroId');
        $nuevoCliente->correo=$request->input('correo');
        $nuevoCliente->numeroTelefono=$request->input('numeroTelefono');
        $nuevoCliente->domicilio=$request->input('domicilio');

        /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
        $creado = $nuevoCliente->save();
        if($creado){
            return redirect()->route('clientes.index')
            ->with('mensaje', "El cliente se registró correctamente");
        }
   }

   // muestra los detalles del cliente
    public function show($id){
        $cliente = Cliente::findOrFail($id);// muestra un solo empleado
        return view('clientes.detalleClientes')->with('cliente', $cliente);
    }

    // editar cliente
    public function edit($id){
        $cliente = Cliente::findOrFail($id);
        return view('clientes.editarClientes', compact('cliente'));
    }

    public function update(Request $request, $id){

        $clientes = Cliente::findOrFail($id);

        /*Validación de campos*/
        $request -> validate([
            'nombreCompleto'=> 'required|regex:/^[a-zA-Z\s\.]+$/|max:50|min:3',
            'numeroId'=> ['required', 'regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/', 'max:15', 'min:15', Rule::unique('clientes')->ignore($clientes->id)],
            'correo'=>['required', 'regex:/(.+)@(.+)\.(.+)$/', 'min:12', 'max:50', Rule::unique('clientes')->ignore($clientes->id)],
            'numeroTelefono'=>['required', 'min:8', 'numeric', 'regex:/^[2,3,8,9][0-9]{7}+$/', Rule::unique('clientes')->ignore($clientes->id)],
            'domicilio'=> 'required|regex:/^[a-zA-Z\0-9\s\.]+$/|min:4|max:50',
            ],[

            'nombreCompleto.required'=> 'El nombre es obligatorio',
            'nombreCompleto.regex'=> 'El nombre completo debe tener solo letras',
            'nombreCompleto.max'=> 'El nombre completo no puede exceder de 50 letras',
            'nombreCompleto.regex'=>'Solo se permiten letras',

            'numeroId.required'=> 'El número de identidad es obligatorio ',
            'numeroId.regex'=> 'El número De identidad debe iniciar con (0 o 1) separado por (-) ejemplo (####-####-#####)',
            'numeroId.unique'=> 'El número De identidad ya existe',

            'correo.required'=>'El correo es obligatorio',
            'correo.regex'=>'El correo es incorrecto ejemplo:(usuario@mail.com ó usuario@mail.es)' ,
            'correo.min'=>'La longitud minima del correo electronico es: 12' ,
            'correo.max'=>'La longitud maxima del correo electronico es: 50' ,
            'correo.unique'=>'El correo ingresado ya existe',

            'numeroTelefono.required'=>'El número telefónico es obligatorio',
            'numeroTelefono.min'=>'El número telefónico debe tener 8 dígitos',
            'numeroTelefono.numeric'=>'El número telefónico debe ser unicamente numérico',
            'numeroTelefono.regex'=>'El número telefónico debe iniciar con (2),(3),(8) ó (9)',
            'numeroTelefono.unique'=>'El número telefónico ingresado ya existe',

            'domicilio.required'=> 'El domicilio es obligatorio' ,
            'domicilio.min'=> 'El domicilio debe tener minimo:4 letras' ,
            'domicilio.max'=> 'El domicilio debe tener maximo:50 letras' ,
            'domicilio.regex'=> 'Un caracter ingresado no es permitido'
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $cliente = Cliente::findOrFail($id);
        $cliente->nombreCompleto=$request->input('nombreCompleto');
        $cliente->numeroId=$request->input('numeroId');
        $cliente->correo=$request->input('correo');
        $cliente->numeroTelefono=$request->input('numeroTelefono');
        $cliente->domicilio=$request->input('domicilio');

        /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
        $creado = $cliente->save();
        if($creado){
            return redirect()->route('clientes.index')
            ->with('mensaje', "El cliente se actualizó correctamente");
        }
   }
}
