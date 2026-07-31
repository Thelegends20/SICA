<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Panel principal de Configuración
     */
    public function index()
    {
        return view('configuracion.index');
    }

    /**
     * Coordinadores
     */
    public function coordinadores()
    {
        return view('configuracion.coordinadores');
    }

    /**
     * Administradores
     */
    public function administradores()
    {
        return view('configuracion.administradores');
    }

    /**
     * Roles y permisos
     */
    public function permisos()
    {
        return view('configuracion.permisos');
    }

    /**
     * Configuración de folios
     */
    public function folios()
    {
        return view('configuracion.folios');
    }

    /**
     * Auditoría
     */
    public function auditoria()
    {
        return view('configuracion.auditoria');
    }

    /**
     * Respaldos
     */
    public function respaldos()
    {
        return view('configuracion.respaldos');
    }

    /**
     * Parámetros generales
     */
    public function parametros()
    {
        return view('configuracion.parametros');
    }
}