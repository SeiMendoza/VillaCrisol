<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\File;
use App\Models\ComidaBebida;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menu = ComidaBebida::all();
        return view ('MenuRestaurante/menuIndex')->with('menu', $menu);
    }

    //buscar comida 
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $menu = ComidaBebida::where('Nombre', 'like', '%'.$text.'%')
        ->orWhere('Precio', 'like', '%'.$text.'%')->paginate(10);
        return view('MenuRestaurante/menuIndex', compact('menu', 'text'));
    }

    public function show($id){
        $comidaBebida = ComidaBebida::findOrfail($id);
      return view ('MenuRestaurante/detalleComidasBebidas')->with('comidaBebida', $comidaBebida);
    }
    public function create(){
        return view ('MenuRestaurante.formularioComidasBebidas');
     }

     //Funcion para guardar el nuevo menu agregado mediante el formulario//
     public function store(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'Nombre'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u',
            'Descripción'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u',
            'Tipo'=>'required|in:bebida,plato,combo' ,
            'Precio'=>'required|regex:/^\d{1,4}(?:\.\d\d\d)*(?:,\d{1,2})?$/',
            'Tamaño'=>'required|in:personal,2 personas,familiar',
            'Imagen'=>'required|image|mimes:jpg,jpeg,png',
        
            ],[

                'Nombre.required'=> 'El Nombre es Obligatorio',
                'Nombre.regex'=> 'El Nombre debe Inciar con letra Mayuscula',
                'Descripción.required'=>'La Descripción es Obligatorio',
                'Tipo.required'=>'El Tipo de menu Obligatorio',
                'Precio.required'=>'El Precio es Obligatorio',
                'Precio.regex'=>'El Precio puede tener (.) y uno o dos decimales despues',
				'Tamaño.required'=>'El Tamaño es obligatorio',
                'Imagen.required'=>'La Imagen es obligatoria',
                'Imagen.mimes'=>'Solo se aceptan imagenes formato:jpg,jpeg,png',
                 
            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevaComidaBebida = new ComidaBebida();
            $nuevaComidaBebida->Nombre=$request->input('Nombre');
            $nuevaComidaBebida->Descripción=$request->input('Descripción');
            $nuevaComidaBebida->Tipo=$request->input('Tipo');
            $nuevaComidaBebida->Precio=$request->input('Precio');
            $nuevaComidaBebida->Tamaño=$request->input('Tamaño');
             
            if($request->hasFile('Imagen')){
        $archivo=$request->file('Imagen');
        $archivo->move(public_path().'/imagenes/menu/',$archivo->getClientOriginalName());
        $nuevaComidaBebida->Imagen=$archivo->getClientOriginalName();
            }
            /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
            $creado = $nuevaComidaBebida->save();
            if($creado){
                return redirect()->route('menu.index')->with('mensaje', "El menu se registró correctamente");
        }
   }

        public function editar($id){
            $comidabebidas = ComidaBebida::findOrfail($id);
            return view ('MenuRestaurante/EditarComidasBebidas')->with('comidabebidas', $comidabebidas);
        }
   public function update(Request $request,$id){

    /*Validación de campos*/
    $request -> validate([
        'Nombre'=> 'required|regex:/^[A-Z][\pLñÑ.\s\-]+$/u',
        'Descripción'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u',
        'Tipo'=>'required|in:bebida,plato,combo' ,
        'Precio'=>'required|regex:/^\d{1,3}(?:\.\d\d\d)*(?:.\d{1,2})?$/',
        'Tamaño'=>'required|in:personal,2 personas,familiar',
        'Imagen'=>'|image|mimes:jpg,jpeg,png',
         
    ],[

            'Nombre.required'=> 'El Nombre es Obligatorio',
            'Nombre.regex'=> 'El Nombre debe Inciar con letra Mayuscula',
            'Descripción.required'=>'La Descripción es Obligatorio',
            'Tipo.required'=>'El Tipo de menu Obligatorio',
            'Precio.required'=>'El Precio  Obligatorio',
            'Precio.regex'=>'El Precio puede tener (.) y uno o dos decimales despues',
            'Tamaño.required'=>'El Tamaño es Obligatorio',
            'Imagen.required'=>'La Imagen es Obligatoria',
            'Imagen.mimes'=>'Solo se aceptan imagenes formato:jpg,jpeg,png',
            'Imagen.image'=>'Solo se aceptan imagenes',
             
        ]);

        /*Variable para reconocer los nuevos registros a la tabla*/
        $comidabebida = ComidaBebida::findOrFail($id);
        
        $comidabebida->Nombre=$request->input('Nombre');
        $comidabebida->Descripción=$request->input('Descripción');
        $comidabebida->Tipo=$request->input('Tipo');
        $comidabebida->Precio=$request->input('Precio');
        $comidabebida->Tamaño=$request->input('Tamaño');
        //$comidabebida->Imagen=$request->input('Imagen');
        
        if($request->hasFile('Imagen')){
            $archivo=$request->file('Imagen');
            $archivo->move(public_path().'/imagenes/menu',$archivo->getClientOriginalName());
            $comidabebida->Imagen=$archivo->getClientOriginalName();
                }else{
                    unset($comidabebida['Imagen']);
                }
        /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
        $creado = $comidabebida->save();
        if($creado){
            return redirect()->route('menu.index')->with('mensaje', "El ".$comidabebida->Nombre." se actualizo correctamente");
        }
}

        public function activo(Request $request,  $id){
            $activar = ComidaBebida::findOrfail($id);
            $activar->Activo = $request->input('activo');

            $create = $activar->save();

            if($create){
                return redirect()->route('menu.index')->with('mensaje','se ha realizado el cambio exitosamente');
            }

        }

}
