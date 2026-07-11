<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afiliacion;
use App\Models\Vehiculo;

class AfiliacionController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        return view('dashboard', [
            'afiliados' => Afiliacion::count(),
            'vehiculos' => Vehiculo::count(),
            'vigentes' => Vehiculo::where('estatus', 'VIGENTE')->count(),
            'vencidos' => Vehiculo::where('estatus', 'VENCIDO')->count(),
        ]);
    }

    /**
     * Lista de afiliados
     */
    public function listado()
    {
        $afiliados = Afiliacion::orderBy('id', 'desc')->get();

        return view('afiliaciones.index', compact('afiliados'));
    }

    /**
     * Formulario de nueva afiliación
     */
    public function create()
    {
        return view('afiliaciones.nueva');
    }

    /**
     * Guardar afiliado
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'telefono'   => 'required|string|max:20',
            'ine'        => 'required|string|max:30',
            'curp'       => 'nullable|string|max:18',
            'rfc'        => 'nullable|string|max:13',
            'correo'     => 'nullable|email',
            'domicilio'  => 'required|string',
            'municipio'  => 'nullable|string|max:100',
            'estado'     => 'nullable|string|max:100',
        ]);

        $folio = 'UCD-A-' . date('Y') . '-' .
            str_pad(Afiliacion::count() + 1, 6, '0', STR_PAD_LEFT);

        $afiliacion = Afiliacion::create([
            'folio_afiliado' => $folio,
            'nombre'         => strtoupper($request->nombre),
            'telefono'       => $request->telefono,
            'ine'            => strtoupper($request->ine),
            'curp'           => strtoupper($request->curp),
            'rfc'            => strtoupper($request->rfc),
            'correo'         => strtolower($request->correo),
            'domicilio'      => strtoupper($request->domicilio),
            'municipio'      => strtoupper($request->municipio),
            'estado'         => strtoupper($request->estado),
            'estatus'        => 'VIGENTE',
            'vigencia'       => now()->addYear(),
        ]);

        return redirect('/afiliado/' . $afiliacion->id);
    }

    /**
     * Expediente del afiliado
     */
    public function show($id)
    {
        $afiliacion = Afiliacion::with('vehiculos')->findOrFail($id);

        return view('afiliaciones.ver', compact('afiliacion'));
    }
}