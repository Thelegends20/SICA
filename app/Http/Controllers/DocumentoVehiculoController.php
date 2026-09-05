<?php

namespace App\Http\Controllers;

use App\Models\DocumentoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentoVehiculoController extends Controller
{
    /**
     * Guarda un documento privado dentro del expediente del vehículo.
     */
    public function store(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'tipo_documento' => [
                'required',
                'string',
                'max:100',
            ],
            'archivo' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:10240',
            ],
            'observaciones' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $archivo = $request->file('archivo');

        $extension = strtolower(
            $archivo->getClientOriginalExtension()
        );

        $nombreOriginal = $archivo->getClientOriginalName();

        $nombreInterno =
            now()->format('YmdHis')
            . '_'
            . Str::uuid()
            . '.'
            . $extension;

        $directorio =
            'vehiculos/'
            . $vehiculo->id
            . '/documentos';

        /*
         * IMPORTANTE:
         * Los documentos se guardan en el disco local privado.
         * No quedan expuestos mediante /storage.
         */
        $ruta = $archivo->storeAs(
            $directorio,
            $nombreInterno,
            'local'
        );

        DocumentoVehiculo::create([
            'vehiculo_id' => $vehiculo->id,
            'tipo_documento' => $request->tipo_documento,
            'nombre_original' => $nombreOriginal,
            'archivo' => $ruta,
            'mime_type' => $archivo->getMimeType(),
            'tamano' => $archivo->getSize(),
            'estatus' => 'PENDIENTE',
            'observaciones' => $request->observaciones,
        ]);

        return back()->with(
            'success',
            'Documento agregado correctamente al expediente del vehículo.'
        );
    }

    /**
     * Actualiza la revisión de un documento.
     */
    public function update(
        Request $request,
        DocumentoVehiculo $documento
    ) {
        $request->validate([
            'estatus' => [
                'required',
                'in:PENDIENTE,VALIDADO,OBSERVADO',
            ],
            'observaciones' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $documento->update([
            'estatus' => $request->estatus,
            'observaciones' => $request->observaciones,
            'revisado_por' => Auth::id(),
            'revisado_at' => now(),
        ]);

        return back()->with(
            'success',
            'Revisión del documento actualizada correctamente.'
        );
    }

    /**
     * Muestra un documento privado en el navegador.
     */
    public function ver(DocumentoVehiculo $documento)
    {
        abort_unless(
            Storage::disk('local')->exists($documento->archivo),
            404
        );

        $rutaCompleta = Storage::disk('local')->path(
            $documento->archivo
        );

        return response()->file(
            $rutaCompleta,
            [
                'Content-Type' =>
                    $documento->mime_type
                    ?: 'application/octet-stream',

                'Content-Disposition' =>
                    'inline; filename="'
                    . str_replace(
                        '"',
                        '',
                        $documento->nombre_original
                            ?: basename($documento->archivo)
                    )
                    . '"',
            ]
        );
    }

    /**
     * Descarga un documento privado.
     */
    public function descargar(
        DocumentoVehiculo $documento
    ) {
        abort_unless(
            Storage::disk('local')->exists($documento->archivo),
            404
        );

        $nombre =
            $documento->nombre_original
            ?: basename($documento->archivo);

        return Storage::disk('local')->download(
            $documento->archivo,
            $nombre
        );
    }

    /**
     * Elimina el archivo y su registro del expediente.
     */
    public function destroy(
        DocumentoVehiculo $documento
    ) {
        if (
            !empty($documento->archivo)
            && Storage::disk('local')->exists(
                $documento->archivo
            )
        ) {
            Storage::disk('local')->delete(
                $documento->archivo
            );
        }

        $documento->delete();

        return back()->with(
            'success',
            'Documento eliminado correctamente del expediente.'
        );
    }
}