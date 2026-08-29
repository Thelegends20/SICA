<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use App\Models\Vehiculo;
use App\Models\Credencial;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Mostrar el panel principal de SICA.
     */
    public function index()
    {
        $totalAfiliados = Afiliacion::count();

        $totalVehiculos = Vehiculo::count();

        $totalCredenciales = Credencial::count();

        $totalUsuarios = User::count();

        return view('dashboard', compact(
            'totalAfiliados',
            'totalVehiculos',
            'totalCredenciales',
            'totalUsuarios'
        ));
    }
}