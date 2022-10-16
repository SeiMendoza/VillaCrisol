<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
