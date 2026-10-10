<?php

use App\Http\Controllers\ConsultaClienteController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Mostrar la página de seguimiento
Route::get('/seguimiento', [
    SeguimientoController::class,
    'index',
])->name('seguimiento');

// Buscar cliente por RUT
Route::post('/seguimiento', [
    SeguimientoController::class,
    'buscar',
])->middleware('throttle:10,1')
    ->name('seguimiento.buscar');

// Registrar consulta del cliente
Route::post('/seguimiento/consultas', [
    ConsultaClienteController::class,
    'store',
])->middleware('throttle:10,1')
    ->name('seguimiento.consultas.store');
