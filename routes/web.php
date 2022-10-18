<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;
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
