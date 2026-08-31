<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    /**
     * Mostrar listado de vehículos.
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('afiliado')
            ->orderByDesc('id')
            ->get();

        return view('vehiculos.index', compact('vehiculos'));
    }


    /**
     * Mostrar formulario de registro.
     */
    public function create()
    {
        $afiliados = Afiliacion::orderBy('nombre')->get();

        return view('vehiculos.nuevo', compact('afiliados'));
    }


    /**
     * Guardar vehículo.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'afiliado_id' => [
                'required',
                'exists:afiliaciones,id',
            ],

            'marca' => [
                'required',
                'string',
                'max:100',
            ],

            'submarca' => [
                'nullable',
                'string',
                'max:100',
            ],

            'anio' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . (now()->year + 1),
            ],

            'color' => [
                'nullable',
                'string',
                'max:50',
            ],

            'placas' => [
                'nullable',
                'string',
                'max:30',
            ],

            'vin' => [
                'required',
                'string',
                'max:17',
            ],

            'motor' => [
                'nullable',
                'string',
                'max:100',
            ],

            'serie_motor' => [
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
                    'robado',
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

        $ultimoId = (int) Vehiculo::max('id');

        $siguiente = $ultimoId + 1;

        $folio = 'SICA-V-'
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
        | TOKEN QR
        |--------------------------------------------------------------------------
        */

        $tokenQr = Str::random(64);


        /*
        |--------------------------------------------------------------------------
        | CREAR VEHÍCULO
        |--------------------------------------------------------------------------
        */

        $vehiculo = new Vehiculo();

        $vehiculo->afiliado_id =
            $datos['afiliado_id'];

        $vehiculo->folio_vehiculo =
            $folio;

        $vehiculo->token_qr =
            $tokenQr;

        $vehiculo->marca =
            $datos['marca'];

        $vehiculo->submarca =
            $datos['submarca'] ?? null;

        $vehiculo->anio =
            $datos['anio'] ?? null;

        $vehiculo->color =
            $datos['color'] ?? null;

        $vehiculo->placas =
            $datos['placas'] ?? null;

        $vehiculo->vin =
            strtoupper($datos['vin']);

        $vehiculo->motor =
            $datos['motor'] ?? null;

        $vehiculo->serie_motor =
            $datos['serie_motor'] ?? null;

        $vehiculo->estatus =
            $datos['estatus'];

        $vehiculo->vigencia =
            $datos['vigencia']
            ?? now()->addYear()->format('Y-m-d');

        $vehiculo->save();


        return redirect(
            '/vehiculos/' . $vehiculo->id
        )->with(
            'success',
            'Vehículo registrado correctamente. Folio: ' . $folio
        );
    }


    /**
     * Mostrar expediente del vehículo.
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::with('afiliado')
            ->findOrFail($id);

        return view(
            'vehiculos.ver',
            compact('vehiculo')
        );
    }


    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $afiliados = Afiliacion::orderBy('nombre')->get();

        return view(
            'vehiculos.editar',
            compact(
                'vehiculo',
                'afiliados'
            )
        );
    }


    /**
     * Actualizar vehículo.
     */
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);


        $datos = $request->validate([
            'afiliado_id' => [
                'required',
                'exists:afiliaciones,id',
            ],

            'marca' => [
                'required',
                'string',
                'max:100',
            ],

            'submarca' => [
                'nullable',
                'string',
                'max:100',
            ],

            'anio' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . (now()->year + 1),
            ],

            'color' => [
                'nullable',
                'string',
                'max:50',
            ],

            'placas' => [
                'nullable',
                'string',
                'max:30',
            ],

            'vin' => [
                'required',
                'string',
                'max:17',
            ],

            'motor' => [
                'nullable',
                'string',
                'max:100',
            ],

            'serie_motor' => [
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
                    'robado',
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

        $vehiculo->afiliado_id =
            $datos['afiliado_id'];

        $vehiculo->marca =
            $datos['marca'];

        $vehiculo->submarca =
            $datos['submarca'] ?? null;

        $vehiculo->anio =
            $datos['anio'] ?? null;

        $vehiculo->color =
            $datos['color'] ?? null;

        $vehiculo->placas =
            $datos['placas'] ?? null;

        $vehiculo->vin =
            strtoupper($datos['vin']);

        $vehiculo->motor =
            $datos['motor'] ?? null;

        $vehiculo->serie_motor =
            $datos['serie_motor'] ?? null;

        $vehiculo->estatus =
            $datos['estatus'];

        $vehiculo->vigencia =
            $datos['vigencia']
            ?? $vehiculo->vigencia;

        $vehiculo->save();


        return redirect(
            '/vehiculos/' . $vehiculo->id
        )->with(
            'success',
            'Vehículo actualizado correctamente.'
        );
    }


    /**
     * Mostrar información QR del vehículo.
     */
    public function qr($id)
    {
        $vehiculo = Vehiculo::with('afiliado')
            ->findOrFail($id);

        return view(
            'vehiculos.qr',
            compact('vehiculo')
        );
    }


    /**
     * Consulta pública mediante token QR.
     *
     * No utiliza el ID interno del vehículo.
     * La unidad se localiza exclusivamente mediante token_qr.
     */
    public function verificacionPublica($token)
    {
        $vehiculo = Vehiculo::with('afiliado')
            ->where('token_qr', $token)
            ->firstOrFail();

        return view(
            'vehiculos.verificacion-publica',
            compact('vehiculo')
        );
    }
}