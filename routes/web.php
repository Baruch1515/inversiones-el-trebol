<?php

use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientesController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
});

require __DIR__.'/auth.php';
