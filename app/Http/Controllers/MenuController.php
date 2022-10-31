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
        ->orWhere('tamaño', 'like', '%'.$text.'%')
        ->orWhere('tipo', 'like', '%'.$text.'%')->paginate(10);
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
            'Nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/u',
            'Descripción'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u',
            'Tipo'=>'required|in:bebida,comida,combo' ,
            'Precio'=>'required|numeric',
            'Tamaño'=>'required|in:personal,2 personas,familiar',
            'Imagen'=>'required|image|mimes:jpg,jpeg,png',

            ],[

                'Nombre.required'=> 'El nombre es obligatorio',
                'Nombre.regex'=> 'El nombre tiene un caracter no permitido',
                'Descripción.required'=>'La descripción es obligatorio',
                'Tipo.required'=>'El tipo de menú es obligatorio',
                'Precio.required'=>'El precio del menú es obligatorio',
                'Precio.numeric'=>'El precio del menú solo acepta numeros enteros',
				'Tamaño.required'=>'El tamaño del menú es obligatorio',
                'Imagen.required'=>'La imagen del menú es obligatoria',
                'Imagen.mimes'=>'Solo se aceptan imagenes formato:jpg,jpeg,png',

            ]);

            /*Variable para reconocer los nuevos registros a la tabla*/
            $nuevaComidaBebida = new ComidaBebida();
            $nuevaComidaBebida->Nombre=$request->input('Nombre');
            $nuevaComidaBebida->Descripción=$request->input('Descripción');
            $nuevaComidaBebida->Tipo=$request->input('Tipo');
            $nuevaComidaBebida->Precio=$request->input('Precio');
            $nuevaComidaBebida->Tamaño=$request->input('Tamaño');
             /*Guarda la  imagen */
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
        'Nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/u',
        'Descripción'=> 'required|regex:/^[\pLñÑ.\s\-]+$/u',
        'Tipo'=>'required|in:bebida,comida,combo' ,
        'Precio'=>'required|numeric',
        'Tamaño'=>'required|in:personal,2 personas,familiar',
        'Imagen'=>'|image|mimes:jpg,jpeg,png',

    ],[

            'Nombre.required'=> 'El nombre es obligatorio',
            'Nombre.regex'=> 'El nombre solo acepta letras',
            'Descripción.required'=>'La descripción del menú es obligatorio',
            'Tipo.required'=>'El tipo de menú es obligatorio',
            'Precio.required'=>'El precio de menú es obligatorio',
            'Precio.numeric'=>'El precio solo acepta numeros enteros',
            'Tamaño.required'=>'El tamaño de menú es obligatorio',
            'Imagen.required'=>'La imagen de menú es obligatoria',
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
       /*Guarda la  imagen */
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
            return redirect()->route('menu.index')->with('mensaje', "".$comidabebida->Nombre." se actualizo correctamente");
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
