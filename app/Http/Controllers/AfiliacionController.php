<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AfiliacionController extends Controller
{
    /**
     * Mostrar todos los afiliados.
     */
    public function index()
    {
        $afiliaciones = Afiliacion::orderByDesc('id')->get();

        return view('afiliaciones.index', compact('afiliaciones'));
    }


    /**
     * Mostrar formulario para nueva afiliación.
     */
    public function create()
    {
        return view('afiliaciones.nueva');
    }


    /**
     * Guardar una nueva afiliación.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',
            ],

            'curp' => [
                'nullable',
                'string',
                'max:18',
            ],

            'rfc' => [
                'nullable',
                'string',
                'max:13',
            ],

            'ine' => [
                'nullable',
                'string',
                'max:30',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
            ],

            'domicilio' => [
                'nullable',
                'string',
                'max:255',
            ],

            'municipio' => [
                'nullable',
                'string',
                'max:100',
            ],

            'estado' => [
                'nullable',
                'string',
                'max:100',
            ],

            'estatus' => [
                'required',
                Rule::in([
                    'activo',
                    'inactivo',
                    'suspendido',
                    'baja',
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

        $ultimoId = (int) Afiliacion::max('id');

        $siguiente = $ultimoId + 1;

        $folio = 'SICA-A-'
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
        | CREAR AFILIADO
        |--------------------------------------------------------------------------
        */

        $afiliacion = new Afiliacion();

        $afiliacion->folio_afiliado = $folio;

        $afiliacion->nombre = $datos['nombre'];

        $afiliacion->curp =
            $datos['curp'] ?? null;

        $afiliacion->rfc =
            $datos['rfc'] ?? null;

        $afiliacion->ine =
            $datos['ine'] ?? null;

        $afiliacion->telefono =
            $datos['telefono'] ?? null;

        $afiliacion->correo =
            $datos['correo'] ?? null;

        $afiliacion->domicilio =
            $datos['domicilio'] ?? null;

        $afiliacion->municipio =
            $datos['municipio'] ?? null;

        $afiliacion->estado =
            $datos['estado'] ?? 'Michoacán';

        $afiliacion->estatus =
            $datos['estatus'];

        $afiliacion->vigencia =
            $datos['vigencia']
            ?? now()->addYear()->format('Y-m-d');

        $afiliacion->save();


        return redirect(
            '/afiliaciones/' . $afiliacion->id
        )->with(
            'success',
            'Afiliación registrada correctamente. Folio: ' . $folio
        );
    }


    /**
     * Mostrar expediente del afiliado.
     */
    public function show($id)
    {
        $afiliado = Afiliacion::findOrFail($id);

        return view(
            'afiliaciones.ver',
            compact('afiliado')
        );
    }


    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $afiliado = Afiliacion::findOrFail($id);

        return view(
            'afiliaciones.editar',
            compact('afiliado')
        );
    }


    /**
     * Actualizar afiliación.
     */
    public function update(Request $request, $id)
    {
        $afiliado = Afiliacion::findOrFail($id);


        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',
            ],

            'curp' => [
                'nullable',
                'string',
                'max:18',
            ],

            'rfc' => [
                'nullable',
                'string',
                'max:13',
            ],

            'ine' => [
                'nullable',
                'string',
                'max:30',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
            ],

            'domicilio' => [
                'nullable',
                'string',
                'max:255',
            ],

            'municipio' => [
                'nullable',
                'string',
                'max:100',
            ],

            'estado' => [
                'nullable',
                'string',
                'max:100',
            ],

            'estatus' => [
                'required',
                Rule::in([
                    'activo',
                    'inactivo',
                    'suspendido',
                    'baja',
                ]),
            ],

            'vigencia' => [
                'nullable',
                'date',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR
        |--------------------------------------------------------------------------
        */

        $afiliado->nombre =
            $datos['nombre'];

        $afiliado->curp =
            $datos['curp'] ?? null;

        $afiliado->rfc =
            $datos['rfc'] ?? null;

        $afiliado->ine =
            $datos['ine'] ?? null;

        $afiliado->telefono =
            $datos['telefono'] ?? null;

        $afiliado->correo =
            $datos['correo'] ?? null;

        $afiliado->domicilio =
            $datos['domicilio'] ?? null;

        $afiliado->municipio =
            $datos['municipio'] ?? null;

        $afiliado->estado =
            $datos['estado'] ?? 'Michoacán';

        $afiliado->estatus =
            $datos['estatus'];

        $afiliado->vigencia =
            $datos['vigencia'] ?? $afiliado->vigencia;

        $afiliado->save();


        return redirect(
            '/afiliaciones/' . $afiliado->id
        )->with(
            'success',
            'Afiliación actualizada correctamente.'
        );
    }
}