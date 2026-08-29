<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AfiliacionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\CredencialController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\AuditoriaController;


/*
|--------------------------------------------------------------------------
| RUTA PÚBLICA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| RUTAS AUTENTICADAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PERFIL DE USUARIO
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | AFILIACIONES
    |--------------------------------------------------------------------------
    */

    Route::get('/afiliaciones', [AfiliacionController::class, 'index'])
        ->name('afiliaciones.index');

    Route::get('/afiliaciones/nueva', [AfiliacionController::class, 'create'])
        ->name('afiliaciones.create');

    Route::post('/afiliaciones', [AfiliacionController::class, 'store'])
        ->name('afiliaciones.store');

    Route::get('/afiliaciones/{id}', [AfiliacionController::class, 'show'])
        ->whereNumber('id')
        ->name('afiliaciones.show');

    Route::get('/afiliaciones/{id}/editar', [AfiliacionController::class, 'edit'])
        ->whereNumber('id')
        ->name('afiliaciones.edit');

    Route::put('/afiliaciones/{id}', [AfiliacionController::class, 'update'])
        ->whereNumber('id')
        ->name('afiliaciones.update');


    /*
    |--------------------------------------------------------------------------
    | VEHÍCULOS
    |--------------------------------------------------------------------------
    */

    Route::get('/vehiculos', [VehiculoController::class, 'index'])
        ->name('vehiculos.index');

    Route::get('/vehiculos/nuevo', [VehiculoController::class, 'create'])
        ->name('vehiculos.create');

    Route::post('/vehiculos', [VehiculoController::class, 'store'])
        ->name('vehiculos.store');

    Route::get('/vehiculos/{id}', [VehiculoController::class, 'show'])
        ->whereNumber('id')
        ->name('vehiculos.show');

    Route::get('/vehiculos/{id}/editar', [VehiculoController::class, 'edit'])
        ->whereNumber('id')
        ->name('vehiculos.edit');

    Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])
        ->whereNumber('id')
        ->name('vehiculos.update');

    Route::get('/vehiculos/{id}/qr', [VehiculoController::class, 'qr'])
        ->whereNumber('id')
        ->name('vehiculos.qr');


    /*
    |--------------------------------------------------------------------------
    | CREDENCIALES
    |--------------------------------------------------------------------------
    */

    Route::get('/credenciales', [CredencialController::class, 'index'])
        ->name('credenciales.index');

    Route::get('/credenciales/crear', [CredencialController::class, 'create'])
        ->name('credenciales.create');

    Route::post('/credenciales', [CredencialController::class, 'store'])
        ->name('credenciales.store');

    Route::get('/credenciales/{id}', [CredencialController::class, 'show'])
        ->whereNumber('id')
        ->name('credenciales.show');

    Route::get('/credenciales/{id}/imprimir', [CredencialController::class, 'imprimir'])
        ->whereNumber('id')
        ->name('credenciales.imprimir');


    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */

    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('usuarios.index');

    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])
        ->name('usuarios.create');

    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');

    Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'edit'])
        ->whereNumber('id')
        ->name('usuarios.edit');

    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])
        ->whereNumber('id')
        ->name('usuarios.update');


    /*
    |--------------------------------------------------------------------------
    | CONFIGURACIÓN
    |--------------------------------------------------------------------------
    */

    Route::get('/configuracion', [ConfiguracionController::class, 'index'])
        ->name('configuracion.index');


    /*
    | Administradores
    */

    Route::get(
        '/configuracion/administradores',
        [ConfiguracionController::class, 'administradores']
    )->name('configuracion.administradores');


    /*
    | Coordinadores
    */

    Route::get(
        '/configuracion/coordinadores',
        [ConfiguracionController::class, 'coordinadores']
    )->name('configuracion.coordinadores');


    /*
    | Folios
    */

    Route::get(
        '/configuracion/folios',
        [ConfiguracionController::class, 'folios']
    )->name('configuracion.folios');

    Route::match(
        ['post', 'put'],
        '/configuracion/folios',
        [ConfiguracionController::class, 'guardarFolios']
    )->name('configuracion.folios.guardar');


    /*
    | Parámetros
    */

    Route::get(
        '/configuracion/parametros',
        [ConfiguracionController::class, 'parametros']
    )->name('configuracion.parametros');

    Route::match(
        ['post', 'put'],
        '/configuracion/parametros',
        [ConfiguracionController::class, 'guardarParametros']
    )->name('configuracion.parametros.guardar');


    /*
    | Permisos
    */

    Route::get(
        '/configuracion/permisos',
        [ConfiguracionController::class, 'permisos']
    )->name('configuracion.permisos');

    Route::put(
        '/configuracion/permisos',
        [ConfiguracionController::class, 'guardarPermisos']
    )->name('configuracion.permisos.guardar');


    /*
    | Respaldos
    */

    Route::get(
        '/configuracion/respaldos',
        [ConfiguracionController::class, 'respaldos']
    )->name('configuracion.respaldos');

    Route::post(
        '/configuracion/respaldos/crear',
        [ConfiguracionController::class, 'crearRespaldo']
    )->name('configuracion.respaldos.crear');

    Route::get(
        '/configuracion/respaldos/{id}/descargar',
        [ConfiguracionController::class, 'descargarRespaldo']
    )->whereNumber('id')
        ->name('configuracion.respaldos.descargar');

    Route::delete(
        '/configuracion/respaldos/{id}/eliminar',
        [ConfiguracionController::class, 'eliminarRespaldo']
    )->whereNumber('id')
        ->name('configuracion.respaldos.eliminar');


    /*
    |--------------------------------------------------------------------------
    | AUDITORÍA
    |--------------------------------------------------------------------------
    */

    Route::get('/auditoria', [AuditoriaController::class, 'index'])
        ->name('auditoria.index');

});


/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN BREEZE
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';