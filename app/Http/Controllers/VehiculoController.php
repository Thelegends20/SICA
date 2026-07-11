<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Afiliacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehiculoController extends Controller
{
    /**
     * Dashboard de vehículos
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('afiliado')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Formulario para registrar un vehículo
     */
    public function create($afiliado)
    {
        $afiliado = Afiliacion::findOrFail($afiliado);

        return view('vehiculos.nuevo', compact('afiliado'));
    }

    /**
     * Guardar vehículo
     */
    public function store(Request $request)
    {
        $request->validate([
            'afiliado_id' => 'required|exists:afiliacions,id',
            'marca'       => 'required|string|max:100',
            'submarca'    => 'nullable|string|max:100',
            'modelo'      => 'required|string|max:100',
            'anio'        => 'required|digits:4',
            'color'       => 'required|string|max:50',
            'vin'         => 'required|string|max:50|unique:vehiculos,vin',
            'motor'       => 'nullable|string|max:100',
            'placas'      => 'nullable|string|max:20',
            'serie_motor' => 'nullable|string|max:100',
        ]);

        $folio = 'UCD-V-' . date('Y') . '-' .
            str_pad(Vehiculo::count() + 1, 6, '0', STR_PAD_LEFT);

        $token = strtoupper(Str::random(8));

        $vehiculo = Vehiculo::create([

            'afiliado_id'    => $request->afiliado_id,
            'folio_vehiculo' => $folio,
            'token_qr'       => $token,

            'marca'          => strtoupper($request->marca),
            'submarca'       => strtoupper($request->submarca),
            'modelo'         => strtoupper($request->modelo),
            'anio'           => $request->anio,
            'color'          => strtoupper($request->color),

            'vin'            => strtoupper($request->vin),
            'motor'          => strtoupper($request->motor),
            'placas'         => strtoupper($request->placas),
            'serie_motor'    => strtoupper($request->serie_motor),

            'estatus'        => 'VIGENTE',
            'vigencia'       => now()->addYear(),
        ]);

        return redirect()->route('vehiculos.show', $vehiculo->id)
            ->with('success', 'Vehículo registrado correctamente.');
    }

    /**
     * Expediente del vehículo
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::with('afiliado')->findOrFail($id);

        return view('vehiculos.ver', compact('vehiculo'));
    }

    /**
     * Formulario para editar
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        return view('vehiculos.editar', compact('vehiculo'));
    }

    /**
     * Actualizar vehículo
     */
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'marca'       => 'required|string|max:100',
            'submarca'    => 'nullable|string|max:100',
            'modelo'      => 'required|string|max:100',
            'anio'        => 'required|digits:4',
            'color'       => 'required|string|max:50',
            'vin'         => 'required|string|max:50|unique:vehiculos,vin,' . $vehiculo->id,
            'motor'       => 'nullable|string|max:100',
            'placas'      => 'nullable|string|max:20',
            'serie_motor' => 'nullable|string|max:100',
        ]);

        $vehiculo->update([
            'marca'       => strtoupper($request->marca),
            'submarca'    => strtoupper($request->submarca),
            'modelo'      => strtoupper($request->modelo),
            'anio'        => $request->anio,
            'color'       => strtoupper($request->color),

            'vin'         => strtoupper($request->vin),
            'motor'       => strtoupper($request->motor),
            'placas'      => strtoupper($request->placas),
            'serie_motor' => strtoupper($request->serie_motor),
        ]);

        return redirect()->route('vehiculos.show', $vehiculo->id)
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Eliminar vehículo
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $afiliado = $vehiculo->afiliado_id;

        $vehiculo->delete();

        return redirect()->route('afiliados.show', $afiliado)
            ->with('success', 'Vehículo eliminado correctamente.');
    }
};