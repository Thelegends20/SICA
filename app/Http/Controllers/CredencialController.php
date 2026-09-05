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
     * Mostrar formulario para crear credencial.
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
        | GENERAR FOLIO
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
        | TOKEN ÚNICO PARA QR
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
     * Mostrar credencial dentro del sistema.
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
     * Mostrar versión para impresión individual.
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


    /**
     * Imprimir varias credenciales en hoja oficio.
     *
     * Puede recibir:
     *
     * ?credenciales[]=1&credenciales[]=2
     *
     * Si no se envían IDs, carga todas las credenciales.
     */
    public function imprimirHoja(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CREDENCIALES SELECCIONADAS
        |--------------------------------------------------------------------------
        */

        $ids = $request->input(
            'credenciales',
            []
        );


        /*
        |--------------------------------------------------------------------------
        | NORMALIZAR IDS
        |--------------------------------------------------------------------------
        */

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $ids = collect($ids)
            ->filter(
                fn ($id) =>
                    is_numeric($id)
                    && (int) $id > 0
            )
            ->map(
                fn ($id) =>
                    (int) $id
            )
            ->unique()
            ->values()
            ->all();


        /*
        |--------------------------------------------------------------------------
        | CONSULTA
        |--------------------------------------------------------------------------
        */

        $consulta = Credencial::with('afiliado');


        /*
        |--------------------------------------------------------------------------
        | SI HAY SELECCIÓN, SOLO CARGAR ESAS CREDENCIALES
        |--------------------------------------------------------------------------
        */

        if (!empty($ids)) {
            $consulta->whereIn(
                'id',
                $ids
            );
        }


        /*
        |--------------------------------------------------------------------------
        | OBTENER CREDENCIALES
        |--------------------------------------------------------------------------
        */

        $credenciales = $consulta
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VISTA DE HOJA OFICIO
        |--------------------------------------------------------------------------
        */

        return view(
            'credenciales.imprimir-hoja',
            compact('credenciales')
        );
    }


    /**
     * Verificación pública mediante token QR.
     *
     * No requiere inicio de sesión.
     */
    public function verificacionPublica($token)
    {
        $credencial = Credencial::with('afiliado')
            ->where('token_qr', $token)
            ->firstOrFail();

        return view(
            'credenciales.verificacion-publica',
            compact('credencial')
        );
    }
}