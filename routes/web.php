<?php

use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ExportController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/nuevo-cliente', [ClientesController::class, 'index'])->name('nuevo-cliente');
Route::post('/guardar-cliente', [ClientesController::class, 'guardar'])->name('guardar.cliente');
Route::get('/clientes', [ClientesController::class, 'clientes'])->name('clientes.ver');
Route::get('/graficas', [CajaController::class, 'graficas'])->name('graficas');

Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update');
Route::get('/nuevo-prestamo', [PrestamosController::class, 'index'])->name('nuevo-prestamo');
Route::post('/guardar-prestamos', [PrestamosController::class, 'store'])->name('prestamos.store');
Route::get('/', [PrestamosController::class, 'dashboard'])->name('dashboard');
Route::get('/prestamos/filtrar', [PrestamosController::class, 'filtrar'])->name('prestamos.filtrar');
Route::delete('/dashboard/{prestamo}', [PrestamosController::class, 'destroy'])->name('prestamo.destroy');

Route::get('/NuevaCuota', [CuotaController::class, 'index'])->name('cuotas.create');
Route::post('/cuotas', [CuotaController::class, 'store'])->name('cuotas.store');

Route::get('/VerCuotas', [CuotaController::class, 'ver'])->name('cuotas');
Route::get('/caja', [CajaController::class, 'index'])->name('caja.index');
Route::post('/caja/guardar-registro', [CajaController::class, 'guardarRegistroDinero'])->name('caja.guardar-registro');

Route::get('/registros', [CajaController::class, 'registros'])->name('registros.index');
Route::delete('/VerCuotas/{cuota}', [CuotaController::class, 'destroy'])->name('cuotas.destroy');

Route::get('/rutas', [RutaController::class, 'index'])->name('rutas');
Route::post('/rutas', [RutaController::class, 'store'])->name('rutas.store');
Route::get('/ruta/{ruta}/editar', [RutaController::class, 'edit'])->name('rutas.edit');
Route::put('/ruta/{ruta}', [RutaController::class, 'update'])->name('rutas.update');
Route::delete('/ruta/{ruta}', [RutaController::class, 'destroy'])->name('rutas.destroy');

Route::get('/ruta/{id}', [RutaController::class, 'index'])->name('ruta.index');

Route::post('/buscar-clientes', [ClientesController::class, 'buscarClientes'])->name('buscar.clientes');

Route::get('/vercuotas', [CuotaController::class, 'ver'])->name('ver.cuotas');

Route::delete('/borrar-registro/{id}', [CajaController::class, 'borrarRegistro'])->name('borrar-registro');

Route::get('/filtrar-registros', [CajaController::class, 'filtrarRegistros'])->name('filtrar-registros');

//Route::get('/exportar-excel', 'CajaController@exportarExcel')->name('exportar');
Route::get('/exportar-excel', [CajaController::class, 'exportarExcel'])->name('exportar');

require __DIR__ . '/auth.php';
