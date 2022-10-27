<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Rule;
use App\Models\Empleado;
use Illuminate\Validation\Rule as ValidationRule;

class EmpleadoController extends Controller
{
    //Funcion para crear un nuevo empleado//
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
            'Domicilio'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u|min:4|max:50' ,
            'FechaDeIngreso'=> 'required|date',
            'Estado'=> 'required|in:temporal,permanente'
            ],[

                'NombreCompleto.required'=> 'El nombre es obligatorio',
                'NombreCompleto.regex'=> 'El nombre debe inciar con letra mayuscula',
                'NúmeroDeIdentidad.required'=> 'El número de identidad es obligatorio ',
                'NúmeroDeIdentidad.regex'=> 'El número de identidad debe iniciar con (0 o 1) separado por (-) ejempl(####-####-#####)',
                'NúmeroDeIdentidad.unique'=> 'El número de identidad ya existe',
                'CorreoElectrónico.required'=>'El correo es obligatorio' ,
                'CorreoElectrónico.unique'=> 'El número de identidad ya existe',
                'CorreoElectrónico.regex'=>'El correo es incorrecto ejempl:(usuario@gmail.com,usuario@yahoo.es)' ,
                'CorreoElectrónico.min'=>'La longitud minima del correo electronico es:12' ,
                'CorreoElectrónico.max'=>'La longitud maxima del correo electronico es:25' ,
                'NúmeroTelefónico.required'=>'El número telefónico es obligatorio',
				'NúmeroTelefónico.unique'=> 'El número de telefóno ya existe',
                'NúmeroTelefónico.regex'=>'El número telefónico debe iniciar con (2),(3),(8),(9)',
                'NúmeroTelefónico.min'=>'El número telefónico debe tener minimo:8 digitos',
                'NúmeroTelefónico.max'=>'El número telefónico debe tener maximo:8 digitos',
				'NúmeroDeReferencia.required'=>'El número de contacto de la empresa es obligatorio ',
				'NúmeroDeReferencia.unique'=> 'El número de contacto de la empresa ya existe',
                'NúmeroDeReferencia.regex'=>'El número de contacto de la empresa debe iniciar con (2),(3),(8),(9)',
                'NúmeroDeReferencia.min'=>'El número de contacto de la empresa debe tener minimo:8 digitos',
                'NúmeroDeReferencia.max'=>'El número de contacto de la empresa debe tener maximo:8 digitos',
                'NombreDeLaReferencia.required'=> 'El nombre de contacto de la empresa es obligatorio' ,
                'NombreDeLaReferencia.regex'=> 'El nombre de contacto de la empresa debe inciar con letra mayuscula' ,
                'Domicilio.required'=> 'El domicilio es obligatorio' ,
                'Domicilio.min'=> 'El domicilio debe tener minimo:4 letras' ,
                'Domicilio.max'=> 'El domicilio debe tener maximo:50 letras' ,
                'FechaDeIngreso.required'=> 'La fecha de ingreso es obligatoria',
                'FechaDeIngreso.date'=> 'La fecha de ingreso no es valida',
                'Estado.required'=> 'El estado es obligatorio'
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
    return view('Empleados/raizEmpleado', compact('empleados', 'text'));


}
   //Funcion para actualizar empleado agregado mediante el formulario//
   public function update(Request $request, $id){

    $empleados = Empleado::findOrFail($id);

    /*Validación de campos*/
    $request -> validate([
        'NombreCompleto'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u',
        'NúmeroDeIdentidad'=> ['required','regex:/^[0,1]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/',  ValidationRule::unique('empleados')->ignore($empleados->id)],
        'CorreoElectrónico'=>['required','regex:/(.+)@(.+)\.(.+)$/', 'min:12|max:25', ValidationRule::unique('empleados')->ignore($empleados->id)],
        'NúmeroTelefónico'=>['required', 'regex:/^[2,3,8,9][0-9]{7}$/', ValidationRule::unique('empleados')->ignore($empleados->id)],
        'NúmeroDeReferencia'=>['required', 'regex:/^[2,3,8,9][0-9]{7}$/', ValidationRule::unique('empleados')->ignore($empleados->id)],
        'NombreDeLaReferencia'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u' ,
        'Domicilio'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u|min:4|max:50' ,
        'FechaDeIngreso'=> 'required|date',
        'Estado'=> 'required|in:temporal,permanente,activo,inactivo'
],[

    'NombreCompleto.required'=> 'El nombre es obligatorio',
    'NombreCompleto.regex'=> 'El nombre debe inciar con letra mayuscula',
    'NúmeroDeIdentidad.required'=> 'El número de identidad es obligatorio ',
    'NúmeroDeIdentidad.regex'=> 'El número de identidad debe iniciar con (0 o 1) separado por (-) ejemplo(####-####-#####)',
    'NúmeroDeIdentidad.unique'=> 'El número de identidad ya existe',
    'CorreoElectrónico.required'=>'El correo es obligatorio' ,
    'CorreoElectrónico.regex'=>'El correo es incorrecto ejempl:(usuario@gmail.com,usuario@yahoo.es)' ,
    'CorreoElectrónico.min'=>'La longitud minima del correo electronico es:12' ,
    'CorreoElectrónico.max'=>'La longitud maxima del correo electronico es:25' ,
    'CorreoElectrónico.unique'=> 'El correo electrónico ya existe',
    'NúmeroTelefónico.required'=>'El número telefónico es obligatorio',
	'NúmeroTelefónico.unique'=> 'El número de telefóno ya existe',
    'NúmeroTelefónico.regex'=>'El número telefónico debe iniciar con (2)(3),(8),(9)',
    'NúmeroTelefónico.min'=>'El número telefónico debe tener minimo:8 digitos',
    'NúmeroTelefónico.max'=>'El número telefónico debe tener maximo:8 digitos',
    'NúmeroDeReferencia.required'=>'El número de referencia es obligatorio ',
	'NúmeroDeReferencia.unique'=> 'El número de referencia ya existe',
    'NúmeroDeReferencia.regex'=>'El número de referencia debe iniciar con (2),(3),(8),(9)',
    'NúmeroDeReferencia.min'=>'El número de referencia debe tener minimo:8 digitos',
    'NúmeroDeReferencia.max'=>'El número de referencia debe tener maximo:8 digitos',
    'NombreDeLaReferencia.required'=> 'El nombre de la referencia es obligatorio' ,
    'NombreDeLaReferencia.regex'=> 'El nombre de la referencia debe inciar con letra mayuscula' ,
    'Domicilio.required'=> 'El domicilio es obligatorio' ,
    'Domicilio.min'=> 'El domicilio debe tener minimo:4 letras' ,
    'Domicilio.max'=> 'El domicilio debe tener maximo:50 letras' ,
    'FechaDeIngreso.required'=> 'La fecha de ingreso es obligatoria',
    'FechaDeIngreso.date'=> 'La fecha de ingreso no es valida',
    'Estado.required'=> 'El estado es obligatorio'
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

