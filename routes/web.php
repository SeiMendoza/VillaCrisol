<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

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
   |---------------|
   | Rutas compras |
   |---------------|
*/

// Visualizar lista de compras
Route::get('/compras', [CompraController::class,'index'])
->name('compras.index');

//Buscar compras
Route::get('/compras/busqueda', [CompraController::class,'search'])
->name('compras.search');

//Agregar nueva compra
Route::get('/compras/create', [CompraController::class,'create'])
->name('compras.create');

Route::post('/compras/create', [CompraController::class, 'store'])
->name('compras.store');

//Ver detalles de compras
Route::get('/compras/{id}', [CompraController::class,'show'])
->name('compras.show')->where('id', '[0-9]+');

// Productos
Route::resource('tarea', TareaController::class);

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
