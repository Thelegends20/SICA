<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use App\Models\Vehiculo;
use App\Models\Credencial;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Mostrar el panel principal de SICA.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | TOTALES GENERALES
        |--------------------------------------------------------------------------
        */

        $afiliados = Afiliacion::count();

        $vehiculos = Vehiculo::count();

        $credenciales = Credencial::count();

        $usuarios = User::count();


        /*
        |--------------------------------------------------------------------------
        | AFILIACIONES ACTIVAS
        |--------------------------------------------------------------------------
        */

        $afiliadosActivos = Afiliacion::where(
            'estatus',
            'VIGENTE'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | VEHÍCULOS ACTIVOS
        |--------------------------------------------------------------------------
        */

        $vehiculosActivos = Vehiculo::where(
            'estatus',
            'VIGENTE'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | VIGENCIAS PRÓXIMAS A VENCER
        |--------------------------------------------------------------------------
        |
        | Se consideran próximas a vencer las afiliaciones cuya vigencia
        | termina entre hoy y los próximos 30 días.
        |
        */

        $hoy = Carbon::today();

        $limite = Carbon::today()->addDays(30);

        $porVencer = Afiliacion::whereNotNull('vigencia')
            ->whereDate('vigencia', '>=', $hoy)
            ->whereDate('vigencia', '<=', $limite)
            ->where('estatus', 'VIGENTE')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | REGISTROS SUSPENDIDOS
        |--------------------------------------------------------------------------
        |
        | Cuenta afiliaciones y vehículos cuyo estatus sea SUSPENDIDO.
        |
        */

        $afiliadosSuspendidos = Afiliacion::where(
            'estatus',
            'SUSPENDIDO'
        )->count();

        $vehiculosSuspendidos = Vehiculo::where(
            'estatus',
            'SUSPENDIDO'
        )->count();

        $suspendidos =
            $afiliadosSuspendidos
            + $vehiculosSuspendidos;


        /*
        |--------------------------------------------------------------------------
        | COMPATIBILIDAD
        |--------------------------------------------------------------------------
        |
        | Conservamos también los nombres anteriores por si alguna otra
        | parte del dashboard o del sistema todavía los utiliza.
        |
        */

        $totalAfiliados = $afiliados;

        $totalVehiculos = $vehiculos;

        $totalCredenciales = $credenciales;

        $totalUsuarios = $usuarios;


        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(
                'afiliados',
                'vehiculos',
                'credenciales',
                'usuarios',

                'afiliadosActivos',
                'vehiculosActivos',
                'porVencer',
                'suspendidos',

                'totalAfiliados',
                'totalVehiculos',
                'totalCredenciales',
                'totalUsuarios'
            )
        );
    }
}