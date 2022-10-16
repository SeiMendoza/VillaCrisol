<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'NombreCompleto'=> 'required|string' , 
            'NúmeroDeIdentidad'=> 'required|regex:/^[0]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/',
            'CorreoElectrónico'=>'required|string' , 
            'NúmeroTelefónico'=>'required|regex:/^[3]{1}[0-9]{7}$/' ,
            'NúmeroDeReferencia'=>'required|regex:/^[3]{1}[0-9]{7}$/' ,
            'NombreDeLaReferencia'=> 'required|string' ,
            'Domicilio'=> 'required|string' ,
            'FechaDeIngreso'=> 'required|date' ,
            'Estado'=> 'required|string' 
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

//buscar compras
public function search(Request $request){
    $text =trim($request->get('busqueda'));
    $empleados = Empleado::where('NombreCompleto', 'like', '%'.$text.'%')
    ->orwhere('NúmeroTelefónico','like', '%'.$text.'%')
    ->orwhere('FechaDeIngreso','like', '%'.$text.'%')
    ->orwhere('Estado','like', '%'.$text.'%')->paginate(10);
    return view('Empleados/raizEmpleado')->with('empleados', $empleados);

    
}

public function destroy($id){
    Empleado :: destroy($id);
    return redirect('/empleados/')->with('mensaje' , 'El empleado ha sido eliminado exitosamente');
   }

   //Funcion para actualizar empleado agregado mediante el formulario//
   public function update(Request $request, $id){
    
    /*Validación de campos*/ 
    $request -> validate([
    'NombreCompleto'=> 'required|string', 
    'NúmeroDeIdentidad'=> 'required|regex:/^[0]{1}[0-9]{3}[-][0-9]{4}[-][0-9]{5}$/',
    'CorreoElectrónico'=>'required|string' , 
    'NúmeroTelefónico'=>'required|regex:/^[3][0-9]{7}$/',
    'NúmeroDeReferencia'=>'required|regex:/^[3][0-9]{7}$/',
    'NombreDeLaReferencia'=> 'required|string' ,
    'Domicilio'=> 'required|string' ,
    'FechaDeIngreso'=> 'required|date' ,
    'Estado'=> 'required' 
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

