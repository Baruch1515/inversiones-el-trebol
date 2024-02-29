<?php

use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\CajaController;

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
Route::get('/', function () {
    return view('dashboard');
});



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/nuevo-cliente', [ClientesController::class, 'index'])->name('nuevo-cliente');
    Route::post('/guardar-cliente', [ClientesController::class, 'guardar'])->name('guardar.cliente');
    Route::get('/clientes', [ClientesController::class, 'clientes'])->name('clientes.ver');
    Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
    Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update');
    Route::get('/nuevo-prestamo', [PrestamosController::class, 'index'])->name('nuevo-prestamo');
    Route::post('/guardar-prestamos', [PrestamosController::class, 'store'])->name('prestamos.store');
    Route::get('/dashboard', [PrestamosController::class, 'dashboard'])->name('dashboard');
    Route::get('/prestamos/filtrar', [PrestamosController::class, 'filtrar'])->name('prestamos.filtrar');
    Route::delete('/dashboard/{prestamo}', [PrestamosController::class, 'destroy'])->name('prestamo.destroy');

    Route::get('/NuevaCuota', [CuotaController::class, 'index'])->name('cuotas.create');
    Route::post('/cuotas', [CuotaController::class, 'store'])->name('cuotas.store');

    Route::get('/VerCuotas', [CuotaController::class, 'ver'])->name('cuotas');
    Route::get('/caja', [CajaController::class, 'index'])->name('caja.index');
    Route::post('/caja/guardar-registro', [CajaController::class, 'guardarRegistroDinero'])->name('caja.guardar-registro');

    Route::get('/registros', [CajaController::class, 'registros'])->name('registros.index');
    Route::delete('/VerCuotas/{cuota}', [CuotaController::class, 'destroy'])->name('cuotas.destroy');
    

