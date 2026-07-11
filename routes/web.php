<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliacionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\CredencialController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [AfiliacionController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Afiliados
|--------------------------------------------------------------------------
*/

Route::get('/afiliados', [AfiliacionController::class, 'listado'])
    ->name('afiliados.index');

Route::get('/nueva', [AfiliacionController::class, 'create'])
    ->name('afiliados.create');

Route::post('/guardar', [AfiliacionController::class, 'store'])
    ->name('afiliados.store');

Route::get('/afiliado/{id}', [AfiliacionController::class, 'show'])
    ->name('afiliados.show');

/*
|--------------------------------------------------------------------------
| Vehículos
|--------------------------------------------------------------------------
*/

Route::get('/vehiculos', [VehiculoController::class, 'index'])
    ->name('vehiculos.index');

Route::get('/vehiculo/nuevo/{afiliado}', [VehiculoController::class, 'create'])
    ->name('vehiculos.create');

Route::post('/vehiculo/guardar', [VehiculoController::class, 'store'])
    ->name('vehiculos.store');

Route::get('/vehiculo/{id}', [VehiculoController::class, 'show'])
    ->name('vehiculos.show');

Route::get('/vehiculo/{id}/editar', [VehiculoController::class, 'edit'])
    ->name('vehiculos.edit');

Route::put('/vehiculo/{id}', [VehiculoController::class, 'update'])
    ->name('vehiculos.update');

Route::delete('/vehiculo/{id}', [VehiculoController::class, 'destroy'])
    ->name('vehiculos.destroy');
    
/*
|--------------------------------------------------------------------------
| Credenciales
|--------------------------------------------------------------------------
*/

Route::get('/credenciales',
    [CredencialController::class, 'index'])
    ->name('credenciales.index');
    
Route::get('/credencial/nueva/{afiliado}', 
    [CredencialController::class, 'create'])
    ->name('credenciales.create');

Route::post('/credencial/guardar',
    [CredencialController::class, 'store'])
    ->name('credenciales.store');

Route::get('/credencial/{id}',
    [CredencialController::class, 'show'])
    ->name('credenciales.show');

/*
|--------------------------------------------------------------------------
| Próximos módulos
|--------------------------------------------------------------------------
*/

Route::view('/pagos', 'proximamente');
Route::view('/renovaciones', 'proximamente');
Route::view('/reportes', 'proximamente');
Route::view('/usuarios', 'proximamente');
Route::view('/configuracion', 'proximamente');