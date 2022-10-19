<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
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
        return view('clientes/listaClientes')->with('clientes', $clientes);
    }

    //Lista de clientes
    public function create(){
        return view ('clientes.registroClientes');
    }

    //Funcion para guardar el nuevo cliente
    public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'nombreCompleto'=> 'required|regex:/^[a-zA-Z\s]+$/',
            'numeroId'=> 'required|unique:clientes,numeroId|regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/',
            'correo'=>'required|regex:/(.+)@(.+)\.(.+)$/|min:12|max:30|unique:clientes',
            'numeroTelefono'=>['min:8','required', 'numeric', 'regex:/^[2,3,8,9][0-9]+$/', 'unique:clientes,numeroTelefono'],
            'domicilio'=> 'required|regex:/^[\pL\s\-]+$/u|min:4|max:50',
            ],[

            'nombreCompleto.required'=> 'El Nombre es un Campo Obligatorio',
            'nombreCompleto.regex'=> 'El Nombre Completo debe tener solo letras',

            'numeroId.required'=> 'El Número De Identidad es un Campo Obligatorio ',
            'numeroId.regex'=> 'El Número De Identidad debe iniciar con (0 o 1) separado por (-) ejempl(####-####-#####)',
            'numeroId.unique'=> 'El Número De Identidad ya existe',

            'correo.required'=>'El correo es un Campo Obligatorio',
            'correo.regex'=>'El correo es incorrecto ejemplo:(usuario@mail.com ó usuario@mail.es)' ,
            'correo.min'=>'La longitud minima del correo electronico es: 12' ,
            'correo.max'=>'La longitud maxima del correo electronico es: 30' ,
            'correo.unique'=>'El correo ingresado ya existe',

            'numeroTelefono.required'=>'El Número Telefónico es un Campo Obligatorio',
            'numeroTelefono.min'=>'El Número Telefónico debe tener 8 dígitos',
            'numeroTelefono.numeric'=>'El Número Telefónico debe ser unicamente numérico',
            'numeroTelefono.regex'=>'El Número Telefónico debe iniciar con (2),(3),(8) ó (9)',
            'numeroTelefono.unique'=>'El Número Telefónico ingresado ya existe',

            'domicilio.required'=> 'El Domicilio es un Campo Obligatorio' ,
            'domicilio.min'=> 'El Domicilio debe tener minimo:4 letras' ,
            'domicilio.max'=> 'El Domicilio debe tener maximo:50 letras' ,
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

}
