<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use App\Models\Credencial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CredencialController extends Controller
{
    /**
     * Mostrar listado de credenciales.
     */
    public function index()
    {
        $credenciales = Credencial::with('afiliado')
            ->orderByDesc('id')
            ->get();

        return view(
            'credenciales.index',
            compact('credenciales')
        );
    }


    /**
     * Mostrar formulario para generar credencial.
     */
    public function create()
    {
        $afiliados = Afiliacion::orderBy('nombre')->get();

        return view(
            'credenciales.crear',
            compact('afiliados')
        );
    }


    /**
     * Guardar nueva credencial.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'afiliado_id' => [
                'required',
                'exists:afiliaciones,id',
            ],

            'estatus' => [
                'required',
                Rule::in([
                    'activa',
                    'cancelada',
                ]),
            ],

            'vigencia' => [
                'nullable',
                'date',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GENERAR FOLIO DE CREDENCIAL
        |--------------------------------------------------------------------------
        */

        $ultimoId = (int) Credencial::max('id');

        $siguiente = $ultimoId + 1;

        $folio = 'SICA-C-'
            . now()->format('Y')
            . '-'
            . str_pad(
                $siguiente,
                6,
                '0',
                STR_PAD_LEFT
            );


        /*
        |--------------------------------------------------------------------------
        | TOKEN DE VERIFICACIÓN
        |--------------------------------------------------------------------------
        */

        $token = Str::random(64);


        /*
        |--------------------------------------------------------------------------
        | CREAR CREDENCIAL
        |--------------------------------------------------------------------------
        */

        $credencial = new Credencial();

        $credencial->afiliado_id =
            $datos['afiliado_id'];

        $credencial->folio_credencial =
            $folio;

        $credencial->token_qr =
            $token;

        $credencial->estatus =
            $datos['estatus'];

        $credencial->vigencia =
            $datos['vigencia']
            ?? now()->addYear()->format('Y-m-d');

        $credencial->save();


        return redirect(
            '/credenciales/' . $credencial->id
        )->with(
            'success',
            'Credencial generada correctamente. Folio: ' . $folio
        );
    }


    /**
     * Mostrar credencial.
     */
    public function show($id)
    {
        $credencial = Credencial::with('afiliado')
            ->findOrFail($id);

        return view(
            'credenciales.ver',
            compact('credencial')
        );
    }


    /**
     * Vista para impresión.
     */
    public function imprimir($id)
    {
        $credencial = Credencial::with('afiliado')
            ->findOrFail($id);

        return view(
            'credenciales.imprimir',
            compact('credencial')
        );
    }
}