<?php

namespace App\Http\Controllers;

use App\Models\Credencial;
use App\Models\Afiliacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CredencialController extends Controller
{

    /**
     * Listado de credenciales
     */
    public function index()
    {
        $credenciales = Credencial::with('afiliado')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('credenciales.index', compact('credenciales'));
    }


    /**
     * Generar credencial para afiliado
     */
    public function create($afiliado)
    {
        $afiliado = Afiliacion::findOrFail($afiliado);

        return view('credenciales.crear', compact('afiliado'));
    }


    /**
     * Guardar credencial
     */
    public function store(Request $request)
    {

        $request->validate([
            'afiliado_id' => 'required|exists:afiliacions,id',
        ]);


        $folio = 'UCD-C-' . date('Y') . '-' .
            str_pad(Credencial::count() + 1, 6, '0', STR_PAD_LEFT);


        $token = strtoupper(Str::random(10));


        $credencial = Credencial::create([

            'afiliado_id'      => $request->afiliado_id,
            'folio_credencial' => $folio,
            'token_qr'         => $token,
            'estatus'          => 'VIGENTE',
            'vigencia'         => now()->addYear(),

        ]);


        return redirect()
            ->route('credenciales.show', $credencial->id)
            ->with('success', 'Credencial generada correctamente.');

    }


    /**
     * Mostrar credencial
     */
    public function show($id)
    {

        $credencial = Credencial::with('afiliado.vehiculos')
            ->findOrFail($id);


        return view('credenciales.ver', compact('credencial'));

    }

}