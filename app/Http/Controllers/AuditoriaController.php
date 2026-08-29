<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Mostrar el historial de auditoría.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | POR AHORA
        |--------------------------------------------------------------------------
        |
        | Dejamos la vista preparada aunque todavía no exista el modelo o tabla
        | de auditoría. Más adelante conectaremos el registro real de movimientos.
        |
        */

        $auditorias = collect();

        return view('auditoria.index', compact('auditorias'));
    }
}