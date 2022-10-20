<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Rule;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    //Funcion para crear un nuevo libro//
    public function create(){
        return view ('empleados.formularioregistroempleado');
     }

     //Funcion para guardar el nuevo empleado agregado mediante el formulario//
    public function store(Request $request){
      
        /*Validación de campos*/ 
        $request -> validate([
            'NombreCompleto'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u',
            'NúmeroDeIdentidad'=> 'required|unique:empleados,NúmeroDeIdentidad|regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/',
            'CorreoElectrónico'=>'required|unique:empleados,CorreoElectrónico|regex:/(.+)@(.+)\.(.+)$/|min:12|max:25' , 
            'NúmeroTelefónico'=>'required|min:8|max:8|unique:empleados,NúmeroTelefónico|regex:/^[2,3,8,9][0-9]{7}$/',
            'NúmeroDeReferencia'=>'required|min:8|max:8|unique:empleados,NúmeroDeReferencia|regex:/^[2,3,8,9][0-9]{7}$/|min:8|max:8',
            'NombreDeLaReferencia'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u' ,
            'Domicilio'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u|min:4|max:50' ,
            'FechaDeIngreso'=> 'required|date',
            'Estado'=> 'required|in:temporal,permanente' 
            ],[
                
                'NombreCompleto.required'=> 'El Nombre es Obligatorio', 
                'NombreCompleto.regex'=> 'El Nombre debe Inciar con letra Mayuscula', 
                'NúmeroDeIdentidad.required'=> 'El Número De Identidad es Obligatorio ',
                'NúmeroDeIdentidad.regex'=> 'El Número De Identidad debe iniciar con (0 o 1) separado por (-) ejempl(####-####-#####)',
                'NúmeroDeIdentidad.unique'=> 'El Número De Identidad ya existe',
                'CorreoElectrónico.required'=>'El correo es un Obligatorio' , 
                'CorreoElectrónico.unique'=> 'El Número De Identidad ya existe',
                'CorreoElectrónico.regex'=>'El correo es incorrecto ejempl:(usuario@gmail.com,usuario@yahoo.es)' ,
                'CorreoElectrónico.min'=>'La longitud minima del correo electronico es:12' , 
                'CorreoElectrónico.max'=>'La longitud maxima del correo electronico es:25' ,  
                'NúmeroTelefónico.required'=>'El Número Telefónico es un Campo Obligatorio',
				'NúmeroTelefónico.unique'=> 'El Número De Telefóno ya existe',
                'NúmeroTelefónico.regex'=>'El Número Telefónico debe iniciar con (2),(3),(8),(9)',
                'NúmeroTelefónico.min'=>'El Número Telefónico debe tener minimo:8 digitos',
                'NúmeroTelefónico.max'=>'El Número Telefónico debe tener maximo:8 digitos',
				'NúmeroDeReferencia.required'=>'El Número Contacto de la Empresa es Obligatorio ',
				'NúmeroDeReferencia.unique'=> 'El Número Contacto de la Empresa ya existe',
                'NúmeroDeReferencia.regex'=>'El Número Contacto de la Empresa debe iniciar con (2),(3),(8),(9)',
                'NúmeroDeReferencia.min'=>'El Número Contacto de la Empresa debe tener minimo:8 digitos',
                'NúmeroDeReferencia.max'=>'El Número Contacto de la Empresa debe tener maximo:8 digitos',
                'NombreDeLaReferencia.required'=> 'El Nombre Contacto de la Empresa es Obligatorio' ,
                'NombreDeLaReferencia.regex'=> 'El Nombre Contacto de la Empresa debe Inciar con letra Mayuscula' ,
                'Domicilio.required'=> 'El Domicilio es un Obligatorio' ,
                'Domicilio.regex'=> 'El Domicilio debe Inciar con letra Mayuscula' ,
                'Domicilio.min'=> 'El Domicilio debe tener minimo:4 letras' ,
                'Domicilio.max'=> 'El Domicilio debe tener maximo:50 letras' ,
                'FechaDeIngreso.required'=> 'La Fecha De Ingreso es un Campo Obligatorio',
                'FechaDeIngreso.date'=> 'La Fecha De Ingreso no es valida',
                'Estado.required'=> 'El Estado es Obligatorio' 
            ]);
    
            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevoEmpleado = new Empleado();
            $nuevoEmpleado->NombreCompleto=$request->input('NombreCompleto');
            $nuevoEmpleado->NúmeroDeIdentidad=$request->input('NúmeroDeIdentidad');
            $nuevoEmpleado->CorreoElectrónico=$request->input('CorreoElectrónico');
            $nuevoEmpleado->NúmeroTelefónico=$request->input('NúmeroTelefónico');
            $nuevoEmpleado->NúmeroDeReferencia=$request->input('NúmeroDeReferencia');
            $nuevoEmpleado->NombreDeLaReferencia=$request->input('NombreDeLaReferencia');
            $nuevoEmpleado->Domicilio=$request->input('Domicilio');
            $nuevoEmpleado->FechaDeIngreso=$request->input('FechaDeIngreso');
            $nuevoEmpleado->Estado=$request->input('Estado');
    
            /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
            $creado = $nuevoEmpleado->save();
            if($creado){
                return redirect()->route('empleado.index')->with('mensaje', "El empleado se registró correctamente");
        } 
   }

   public function index(){
    $empleados= Empleado :: paginate(10);
    return view ('empleados.raizEmpleado')->with('empleados', $empleados);
}
//buscar empleado
public function search(Request $request){
    $text =trim($request->get('busqueda'));
    $empleados = Empleado::where('NombreCompleto', 'like', '%'.$text.'%')->
	orwhere('NúmeroDeIdentidad', 'like', '%'.$text.'%')->paginate(10);
    return view('Empleados/raizEmpleado')->with('empleados', $empleados);

    
}
   //Funcion para actualizar empleado agregado mediante el formulario//
   public function update(Request $request, $id){
    
    /*Validación de campos*/ 
    $request -> validate([
        'NombreCompleto'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u',
        'NúmeroDeIdentidad'=> 'required|unique:empleados,NúmeroDeIdentidad|regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/' ,
        'CorreoElectrónico'=>'required|unique:empleados,CorreoElectrónico|regex:/(.+)@(.+)\.(.+)$/|min:12|max:25'  , 
        'NúmeroTelefónico'=>'required|unique:empleados,NúmeroTelefónico|regex:/^[2,3,8,9][0-9]{7}$/' ,
        'NúmeroDeReferencia'=>'required|unique:empleados,NúmeroDeReferencia|regex:/^[2,3,8,9][0-9]{7}$/' ,
        'NombreDeLaReferencia'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u' ,
        'Domicilio'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u|min:4|max:50' ,
        'FechaDeIngreso'=> 'required|date',
        'Estado'=> 'required|in:temporal,permanente,activo,inactivo' 
],[
    
    'NombreCompleto.required'=> 'El Nombre es Obligatorio', 
    'NombreCompleto.regex'=> 'El Nombre debe Inciar con letra Mayuscula', 
    'NúmeroDeIdentidad.required'=> 'El Número De Identidad es Obligatorio ',
    'NúmeroDeIdentidad.regex'=> 'El Número De Identidad debe iniciar con (0 o 1) separado por (-) ejemplo(####-####-#####)',
    'NúmeroDeIdentidad.unique'=> 'El Número De Identidad ya existe',
    'CorreoElectrónico.required'=>'El correo es Obligatorio' , 
    'CorreoElectrónico.regex'=>'El correo es incorrecto ejempl:(usuario@gmail.com,usuario@yahoo.es)' ,
    'CorreoElectrónico.min'=>'La longitud minima del correo electronico es:12' , 
    'CorreoElectrónico.max'=>'La longitud maxima del correo electronico es:25' , 
    'CorreoElectrónico.unique'=> 'El Correo Electrónico ya existe', 
    'NúmeroTelefónico.required'=>'El Número Telefónico es Obligatorio',
	'NúmeroTelefónico.unique'=> 'El Número De Telefóno ya existe',
    'NúmeroTelefónico.regex'=>'El Número Telefónico debe iniciar con (2)(3),(8),(9)',
    'NúmeroTelefónico.min'=>'El Número Telefónico debe tener minimo:8 digitos',
    'NúmeroTelefónico.max'=>'El Número Telefónico debe tener maximo:8 digitos',
    'NúmeroDeReferencia.required'=>'El Número De Referencia es Obligatorio ',
	'NúmeroDeReferencia.unique'=> 'El Número De Referencia ya existe',
    'NúmeroDeReferencia.regex'=>'El Número De Referencia debe iniciar con (2),(3),(8),(9)',
    'NúmeroDeReferencia.min'=>'El Número De Referencia debe tener minimo:8 digitos',
    'NúmeroDeReferencia.max'=>'El Número De Referencia debe tener maximo:8 digitos',
    'NombreDeLaReferencia.required'=> 'El Nombre De La Referencia es Obligatorio' ,
    'NombreDeLaReferencia.regex'=> 'El Nombre De La Referencia debe Inciar con letra Mayuscula' ,
    'Domicilio.required'=> 'El Domicilio es Obligatorio' ,
    'Domicilio.regex'=> 'El Domicilio debe Inciar con letra Mayuscula' ,
    'Domicilio.min'=> 'El Domicilio debe tener minimo:4 letras' ,
    'Domicilio.max'=> 'El Domicilio debe tener maximo:50 letras' ,
    'FechaDeIngreso.required'=> 'La Fecha De Ingreso es Obligatorio',
    'FechaDeIngreso.date'=> 'La Fecha De Ingreso no es valida',
    'Estado.required'=> 'El Estado es un Obligatorio' 
]);

    /*Variable para reconocer los nuevos registros a la tabla*/
    $Empleado = Empleado::findOrFail($id);

    $Empleado->NombreCompleto=$request->input('NombreCompleto');
    $Empleado->NúmeroDeIdentidad=$request->input('NúmeroDeIdentidad');
    $Empleado->CorreoElectrónico=$request->input('CorreoElectrónico');
    $Empleado->NúmeroTelefónico=$request->input('NúmeroTelefónico');
    $Empleado->NúmeroDeReferencia=$request->input('NúmeroDeReferencia');
    $Empleado->NombreDeLaReferencia=$request->input('NombreDeLaReferencia');
    $Empleado->Domicilio=$request->input('Domicilio');
    $Empleado->FechaDeIngreso=$request->input('FechaDeIngreso');
    $Empleado->Estado=$request->input('Estado');

    /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
    $creado = $Empleado->save();
    if($creado){
        return redirect()->route('empleado.index')->with('mensaje', "El empleado ".$Empleado->NombreCompleto." se actualizo correctamente");
    } 
}
// editar empleado
public function editar ($id){
    $Empleado = Empleado::findOrfail($id);
    return view('empleados.EditarEmpleado')->with('empleado',$Empleado);
}
// muestra los detalles del empleado
public function show ($id){
    $Empleado = Empleado::findOrfail($id);// muestra un solo empleado
    return view('empleados.DetallesEmpleado')->with('empleado',$Empleado);
}
}

