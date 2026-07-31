<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AfiliacionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\CredencialController;


/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


/*
|--------------------------------------------------------------------------
| Sistema SICA protegido
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {


    /*
|--------------------------------------------------------------------------
| Usuarios
|--------------------------------------------------------------------------
*/

Route::get('/usuarios',
    [App\Http\Controllers\UsuarioController::class,'index'])
    ->name('usuarios.index');

Route::get('/usuarios/nuevo',
    [App\Http\Controllers\UsuarioController::class,'create'])
    ->name('usuarios.create');

Route::post('/usuarios',
    [App\Http\Controllers\UsuarioController::class,'store'])
    ->name('usuarios.store');

Route::get('/usuarios/{user}/editar',
    [App\Http\Controllers\UsuarioController::class,'edit'])
    ->name('usuarios.edit');

Route::put('/usuarios/{user}',
    [App\Http\Controllers\UsuarioController::class,'update'])
    ->name('usuarios.update');
    
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AfiliacionController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Afiliados
    |--------------------------------------------------------------------------
    */

    Route::get('/afiliados',
        [AfiliacionController::class, 'listado'])
        ->name('afiliados.index');


    Route::get('/nueva',
        [AfiliacionController::class, 'create'])
        ->name('afiliados.create');


    Route::post('/guardar',
        [AfiliacionController::class, 'store'])
        ->name('afiliados.store');


    Route::get('/afiliado/{id}',
        [AfiliacionController::class, 'show'])
        ->name('afiliados.show');


    /*
    |--------------------------------------------------------------------------
    | Vehículos
    |--------------------------------------------------------------------------
    */

    Route::get('/vehiculos',
        [VehiculoController::class, 'index'])
        ->name('vehiculos.index');


    Route::get('/vehiculo/nuevo/{afiliado}',
        [VehiculoController::class, 'create'])
        ->name('vehiculos.create');


    Route::post('/vehiculo/guardar',
        [VehiculoController::class, 'store'])
        ->name('vehiculos.store');


    Route::get('/vehiculo/{id}',
        [VehiculoController::class, 'show'])
        ->name('vehiculos.show');


    Route::get('/vehiculo/{id}/editar',
        [VehiculoController::class, 'edit'])
        ->name('vehiculos.edit');


    Route::put('/vehiculo/{id}',
        [VehiculoController::class, 'update'])
        ->name('vehiculos.update');


    Route::delete('/vehiculo/{id}',
        [VehiculoController::class, 'destroy'])
        ->name('vehiculos.destroy');


    /*
    |--------------------------------------------------------------------------
    | Credenciales (internas del expediente)
    |--------------------------------------------------------------------------
    */

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
    | Configuración
    |--------------------------------------------------------------------------
    */

    Route::view('/configuracion', 'proximamente')
        ->name('configuracion');


    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile',
        [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile',
        [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile',
        [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';