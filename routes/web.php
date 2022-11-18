<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegCompraProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
   |-----------------|
   | Rutas empleados |
   |-----------------|
*/

Route::get('/', function () {
   return view('inicio');
});

//Ruta para crear y mostrar el formulario y permitir el registro de empleados//
Route::get('/empleados/crear' ,  [EmpleadoController::class,'create'])->name('empleado.crear');

//Buscar empleados
Route::get('/empleados/busqueda',  [EmpleadoController::class,'search'])
->name('empleados.search');

//Ruta para recibir los datos del formulario y guardarlos//
Route::post('/empleados/crear' ,  [EmpleadoController::class,'store'])->name('empleado.guardar');

//Ruta para mostrar listado general de empleados//
Route::get('/empleados' ,  [EmpleadoController::class,'index'])->name('empleado.index');

//ruta para editar el empleado
Route::get('/empleados/{id}/editar', [EmpleadoController::class,'editar'])
->name('empleado.editar')->where('id','[0-9]+');
// ruta para actualizar empleado
Route::put('/empleados/{id}/editar', [EmpleadoController::class,'update'])//envia los datos al servidor
->name('empleado.update')->where('id','[0-9]+');
//Ruta para mostrar los detalles del empleado//
Route::get('/empleados/{id}' ,  [EmpleadoController::class,'show'])
->name('empleado.mostrar')
->where('id' ,'[0-9]+');




//ruta raiz
Route::get('/', [HomeController::class, 'index'])->name('index');

//Secciones:

Route::get('/restaurante', [HomeController::class, 'restaurante'])->name('restaurante');


/*
   |----------------|
   | Rutas clientes |
   |----------------|
*/

//Lista de clientes
Route::get('/clientes', [ClienteController::class,'index'])
->name('clientes.index');

//Buscar clientes
Route::get('/clientes/busqueda', [ClienteController::class,'search'])
->name('clientes.search');

//Agregar nuevo cliente
Route::get('/clientes/create', [ClienteController::class,'create'])
->name('clientes.create');

Route::post('/clientes/create', [ClienteController::class, 'store'])
->name('clientes.store');

//Ruta para mostrar los detalles del cliente
Route::get('/clientes/{id}' , [ClienteController::class,'show'])
->name('clientes.show')
->where('id','[0-9]+');

//ruta para editar el cliente
Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])
->name('clientes.edit')->where('id','[0-9]+');

// ruta para actualizar datos del cliente
Route::put('/clientes/{id}/editar', [ClienteController::class,'update'])
->name('clientes.update')->where('id','[0-9]+');

/*
   |----------------|
   |   Rutas Menú   |
   |----------------|
*/

//Menú de comidas y bebidas
Route::get('/menu', [MenuController::class,'index'])
->name('menu.index');

//Buscar clientes
Route::get('/menu/busqueda', [MenuController::class,'search'])
->name('menu.search');

//Detalle Comida y bebida

Route::get('/menu/detalle/{id}', [MenuController::class,'show'])
->name('menu.show')->where('id','[0-9]+');

//Agregar nueva Comida y bebida
Route::get('/menu/create', [MenuController::class,'create'])
->name('menu.create');

Route::post('/menu/create', [MenuController::class, 'store'])
->name('menu.store');

//ruta para editar Comidas y Bebidas
Route::get('/menu/{id}/editar', [MenuController::class,'editar'])
->name('menu.editar')->where('id','[0-9]+');

// ruta para actualizar la comida y bebida
Route::put('/menu/{id}/editar', [MenuController::class,'update'])//envia los datos al servidor
->name('menu.update')->where('id','[0-9]+');

//ruta para activar o desactivar comidas o bebidas
Route::put('/menu/{id}/activar', [MenuController::class,'activo'])
->name('menu.activar')->where('id','[0-9]+');


/*
   |------------------------------------|
   |   Rutas de Registros de productos  |
   |------------------------------------|
*/

Route::get('/create/producto', [ProductoController::class,'createProducto'])
->name('producto.create');

Route::post('/create/producto', [ProductoController::class, 'storeProducto'])
->name('producto.store');


/*
   |---------------------------------------------|
   |   Rutas de Registros  compras de productos  |
   |---------------------------------------------|
*/
Route::get('/regcompra', [RegCompraProductController::class,'index'])
->name('regcompra.index');

Route::get('/regcompra/busqueda', [RegCompraProductController::class,'search'])
->name('regcompra.search');

Route::get('/create/regcompra', [RegCompraProductController::class,'create'])
->name('regcompra.create');

Route::post('/create/regcompra', [RegCompraProductController::class, 'store'])
->name('regcompra.store');

Route::delete('/regcompra/{id}/borrar',[RegCompraProductController::class,'destroy'])
->name('regcompra.borrar')->where('id','[0-9]+');

Route::post('/create/regcompra/detalle',[RegCompraProductController::class, 'detalle'])
->name('regcompra.detalle');

Route::put('/create/regcompra/detalle/{id}',[RegCompraProductController::class, 'detalleeditar'])
->name('regcompra.detalleeditar')->where('id','[0-9]+');

Route::get('/regcompra/detalle/{id}',[RegCompraProductController::class, 'detail'])
->name('regcompra.detail')->where('id','[0-9]+');


/*
   |-----------------|
   | Rutas Productos |
   |-----------------|
*/

//Inventarios
Route::get('/inventario', [ProductoController::class,'index'])
->name('inventario.index');

Route::get('/invrestaurante/desc-PDF', [ProductoController::class,'restaurantePDF'])
->name('inventario.restaurantepdf');
//Buscar productos del inventario
Route::get('inventario/restaurante/busqueda', [ProductoController::class,'searchRestaurante'])
->name('restaurante.search');

//Detalle de productos del inventario
Route::get('inventario/restaurante/detalle/{id}', [ProductoController::class,'showRestaurante'])
->name('restaurante.show')->where('id','[0-9]+');

Route::get('/inventario/{id}/editar', [ProductoController::class,'edit'])
->name('inventario.edit')->where('id','[0-9]+');

// ruta para actualizar la comida y bebida
Route::put('/inventario/{id}/editar', [ProductoController::class,'update'])//envia los datos al servidor
->name('inventario.update')->where('id','[0-9]+');

//Inventario piscina
Route::get('/invpiscina', [ProductoController::class,'piscinaindex'])
->name('inventario.piscinaindex');
// reporte de piscina
Route::get('/invpiscina/desc-PDF', [ProductoController::class,'piscinaPDF'])
->name('inventario.piscinapdf');
//Buscar productos del inventario
Route::get('inventario/piscina/busqueda', [ProductoController::class,'searchPiscina'])
->name('piscina.search');