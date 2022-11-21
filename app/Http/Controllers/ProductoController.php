<?php

namespace App\Http\Controllers;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use PDF;
//use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\RcompraProducto;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    //funcion para crear un nuevo producto
    public function createProducto(){
        return view('productos.registroProducto');
    }

    //funcion para validar y guardar el nuevo producto
    public function storeProducto(Request $request){

        /*Validación de campos*/
        $request -> validate([
            'nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/|min:3|max:50',
            'categoria' => 'required|in:restaurante,piscina,siembras,animales',
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.;:(),\s\-]+$/u|min:5|max:150'
        ],
        [
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.regex'=> 'El nombre tiene un caracter no valido',
            'nombre.min'=> 'El nombre requiere una longitud mínima de 3',
            'nombre.max'=> 'El nombre requiere una longitud máxima de 50',

            'categoria.required' =>'La categoría es obligatoria',

            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no valido',
            'descripcion.min'=>'La descripción requiere una longitud mínima de 5',
            'descripcion.max'=>'La descripción requiere una longitud máxima de 150',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $nuevoProducto = new Producto();
         $nuevoProducto->nombre=$request->input('nombre');
         $nuevoProducto->descripcion=$request->input('descripcion');
         $nuevoProducto->categoria=$request->input('categoria');

         /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
         $creado = $nuevoProducto->save();
         if($creado){
             return redirect()->route('index')->with('mensaje', "El producto se registró correctamente");
         }
    }

    // editar productos
    public function edit($id){
        $producto = Producto::findOrFail($id);
        return view('productos/editarProducto', compact('producto'));
    }

    public function update(Request $request, $id){

        /*Validación de campos*/
        $request -> validate([
            'nombre'=> 'required|regex:/^[a-zA-Z\s\pLñÑ.\-]+$/|min:3|max:50',
            'categoria' => 'required|in:restaurante,piscina,siembras,animales',
            'descripcion'=> 'required|regex:/^[a-zA-Z\0-9\pLñÑ.;:(),\s\-]+$/u|min:5|max:150'
        ],
        [
            'nombre.required'=> 'El nombre es obligatorio',
            'nombre.regex'=> 'El nombre tiene un caracter no valido',
            'nombre.min'=> 'El nombre requiere una longitud mínima de 3',
            'nombre.max'=> 'El nombre requiere una longitud máxima de 50',

            'categoria.required' =>'La categoría es obligatoria',

            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.regex'=>'La descripción tiene un caracter no valido',
            'descripcion.min'=>'La descripción requiere una longitud mínima de 5',
            'descripcion.max'=>'La descripción requiere una longitud máxima de 150',
        ]);

         /*Variable para reconocer los nuevos registros a la tabla*/
         $producto = Producto::findOrFail($id);
         $producto->nombre=$request->input('nombre');
         $producto->descripcion=$request->input('descripcion');
         $producto->categoria=$request->input('categoria');

         /*Variable para guardar los nuevos registros de la tabla y retornar a la vista index*/
         $creado = $producto->save();
         if($creado){
             return redirect()->route('inventario.index')->with('mensaje', "El producto se actualizó correctamente");
         }
    }



    // ----------------------------------Restaurante----------------------------------------- //

    //Lista de productos
    public function index(){
        $productos= Producto::where('categoria', '=', 'restaurante')->paginate(10);
        return view ('productos/inventarios')->with('productos', $productos);
    }
//pdf de restaurante
public function restaurantePDF(Request $request){
    $text =trim($request->get('busqueda'));
    $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'restaurante')->paginate(10); 
$vista = view('productos.Reporte_restaurante')->with('productos',$productos);
$options = new Options();
$options->set('isRemoteEnabled', TRUE);

$dompdf = new Dompdf($options);
    // Definimos el tamaño y orientación del papel que queremos.
    $dompdf->setPaper('A4', 'portrait');
    // Cargamos el contenido HTML.
    $dompdf->loadHtml(utf8_decode($vista));
    // Renderizamos el documento PDF.
    $dompdf->render();
    // Enviamos el fichero PDF al navegador.
  $dompdf->stream("Reporte-restaurante_".$text.".pdf"); 
}
    //buscar productos
    public function searchRestaurante(Request $request){
        $text =trim($request->get('busqueda'));
        $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'restaurante')->paginate(10);
        return view('BuscarInventario/BuscarR', compact('productos', 'text'));
    }

    //función para ver productos
    public function showRestaurante($id){
        $producto = Producto::findOrfail($id);
        $producto->detalle_compra;
        $detalles = DetalleCompra::all();
        $detalle = DetalleCompra::findOrFail($id);
        $compra = Compra::findOrFail($id);
        return view ('productos/detalleRestaurante')->with('producto', $producto)
        ->with('detalles', $detalles)
        ->with('detalle', $detalle)
        ->with('compra', $compra);
    }
//Lista de productos de piscina
public function piscinaindex(){
    $productos= Producto::where('categoria', '=', 'piscina')->paginate(10);
    return view ('piscina/invpiscina')->with('productos', $productos);
}
//pdf de piscina
public function piscinaPDF(Request $request){
    $text =trim($request->get('busqueda'));
    $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'piscina')->paginate(10);
$vista = view('piscina.Reporte_piscina')->with('productos',$productos);
$options = new Options();
$options->set('isRemoteEnabled', TRUE);

$dompdf = new Dompdf($options);
    // Definimos el tamaño y orientación del papel que queremos.
    $dompdf->setPaper('A4', 'portrait');
    // Cargamos el contenido HTML.
    $dompdf->loadHtml(utf8_decode($vista));
    // Renderizamos el documento PDF.
    $dompdf->render();
    // Enviamos el fichero PDF al navegador.
  $dompdf->stream("Reporte-piscina_".$text.".pdf"); 
}
//buscar productos
public function searchPiscina(Request $request){
    $text =trim($request->get('busqueda'));
    $productos = Producto::where('nombre', 'like', '%'.$text.'%')->where('categoria', '=', 'piscina')->paginate(10);
    return view('BuscarInventario/BuscarP', compact('productos', 'text')); 
     
    
}
}
