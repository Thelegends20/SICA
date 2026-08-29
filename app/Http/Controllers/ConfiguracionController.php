<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    /**
     * Pantalla principal de configuración.
     */
    public function index()
    {
        return view('configuracion.index');
    }


    /**
     * Administradores principales.
     */
    public function administradores()
    {
        $administradores = User::where(
            'rol',
            'ADMIN_PRINCIPAL'
        )
        ->orderBy('name')
        ->get();

        return view(
            'configuracion.administradores',
            compact('administradores')
        );
    }


    /**
     * Coordinadores.
     */
    public function coordinadores()
    {
        $coordinadores = User::where(
            'rol',
            'COORDINADOR'
        )
        ->orderBy('name')
        ->get();

        return view(
            'configuracion.coordinadores',
            compact('coordinadores')
        );
    }


    /**
     * Pantalla de configuración de folios.
     */
    public function folios()
    {
        $folios = (object) [
            'prefijo_afiliado' => config(
                'sica.prefijo_afiliado',
                'SICA-A'
            ),

            'siguiente_afiliado' => config(
                'sica.siguiente_afiliado',
                1
            ),

            'prefijo_vehiculo' => config(
                'sica.prefijo_vehiculo',
                'SICA-V'
            ),

            'siguiente_vehiculo' => config(
                'sica.siguiente_vehiculo',
                1
            ),

            'prefijo_credencial' => config(
                'sica.prefijo_credencial',
                'SICA-C'
            ),

            'siguiente_credencial' => config(
                'sica.siguiente_credencial',
                1
            ),
        ];

        return view(
            'configuracion.folios',
            compact('folios')
        );
    }


    /**
     * Guardar configuración de folios.
     */
    public function guardarFolios(Request $request)
    {
        $datos = $request->validate([
            'prefijo_afiliado' => [
                'required',
                'string',
                'max:30',
            ],

            'siguiente_afiliado' => [
                'required',
                'integer',
                'min:1',
            ],

            'prefijo_vehiculo' => [
                'required',
                'string',
                'max:30',
            ],

            'siguiente_vehiculo' => [
                'required',
                'integer',
                'min:1',
            ],

            'prefijo_credencial' => [
                'required',
                'string',
                'max:30',
            ],

            'siguiente_credencial' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $this->guardarConfiguracionLocal([
            'prefijo_afiliado' =>
                $datos['prefijo_afiliado'],

            'siguiente_afiliado' =>
                $datos['siguiente_afiliado'],

            'prefijo_vehiculo' =>
                $datos['prefijo_vehiculo'],

            'siguiente_vehiculo' =>
                $datos['siguiente_vehiculo'],

            'prefijo_credencial' =>
                $datos['prefijo_credencial'],

            'siguiente_credencial' =>
                $datos['siguiente_credencial'],
        ]);

        return redirect('/configuracion/folios')
            ->with(
                'success',
                'Configuración de folios guardada correctamente.'
            );
    }


    /**
     * Pantalla de parámetros generales.
     */
    public function parametros()
    {
        $parametros = (object) [
            'nombre_sistema' => config(
                'sica.nombre_sistema',
                'SICA'
            ),

            'nombre_completo' => config(
                'sica.nombre_completo',
                'Sistema Integral de Control y Afiliación'
            ),

            'organizacion' => config(
                'sica.organizacion',
                ''
            ),

            'telefono' => config(
                'sica.telefono',
                ''
            ),

            'correo' => config(
                'sica.correo',
                ''
            ),

            'direccion' => config(
                'sica.direccion',
                ''
            ),

            'vigencia_afiliacion_meses' => config(
                'sica.vigencia_afiliacion_meses',
                12
            ),

            'vigencia_credencial_meses' => config(
                'sica.vigencia_credencial_meses',
                12
            ),

            'estado_default' => config(
                'sica.estado_default',
                'Michoacán'
            ),
        ];

        return view(
            'configuracion.parametros',
            compact('parametros')
        );
    }


    /**
     * Guardar parámetros generales.
     */
    public function guardarParametros(Request $request)
    {
        $datos = $request->validate([
            'nombre_sistema' => [
                'required',
                'string',
                'max:30',
            ],

            'nombre_completo' => [
                'required',
                'string',
                'max:150',
            ],

            'organizacion' => [
                'nullable',
                'string',
                'max:150',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:30',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vigencia_afiliacion_meses' => [
                'required',
                'integer',
                'min:1',
                'max:120',
            ],

            'vigencia_credencial_meses' => [
                'required',
                'integer',
                'min:1',
                'max:120',
            ],

            'estado_default' => [
                'required',
                'string',
                'max:100',
            ],
        ]);

        $this->guardarConfiguracionLocal($datos);

        return redirect('/configuracion/parametros')
            ->with(
                'success',
                'Parámetros guardados correctamente.'
            );
    }


    /**
     * Pantalla de permisos.
     */
    public function permisos()
    {
        $permisos = [
            'ADMIN_PRINCIPAL' => [
                'dashboard' => true,
                'afiliaciones_ver' => true,
                'afiliaciones_crear' => true,
                'afiliaciones_editar' => true,
                'vehiculos_ver' => true,
                'vehiculos_crear' => true,
                'vehiculos_editar' => true,
                'credenciales_ver' => true,
                'credenciales_crear' => true,
                'usuarios_ver' => true,
                'usuarios_crear' => true,
                'usuarios_editar' => true,
                'configuracion' => true,
                'auditoria' => true,
            ],

            'COORDINADOR' => config(
                'sica.permisos_coordinador',
                [
                    'dashboard' => true,
                    'afiliaciones_ver' => true,
                    'afiliaciones_crear' => true,
                    'afiliaciones_editar' => true,
                    'vehiculos_ver' => true,
                    'vehiculos_crear' => true,
                    'vehiculos_editar' => true,
                    'credenciales_ver' => true,
                    'credenciales_crear' => true,
                    'usuarios_ver' => false,
                    'usuarios_crear' => false,
                    'usuarios_editar' => false,
                    'configuracion' => false,
                    'auditoria' => false,
                ]
            ),
        ];

        return view(
            'configuracion.permisos',
            compact('permisos')
        );
    }


    /**
     * Guardar permisos de coordinadores.
     */
    public function guardarPermisos(Request $request)
    {
        $todos = [
            'dashboard',
            'afiliaciones_ver',
            'afiliaciones_crear',
            'afiliaciones_editar',
            'vehiculos_ver',
            'vehiculos_crear',
            'vehiculos_editar',
            'credenciales_ver',
            'credenciales_crear',
            'usuarios_ver',
            'usuarios_crear',
            'usuarios_editar',
            'configuracion',
            'auditoria',
        ];

        $enviados = $request->input(
            'permisos.COORDINADOR',
            []
        );

        $permisosCoordinador = [];

        foreach ($todos as $permiso) {
            $permisosCoordinador[$permiso] =
                array_key_exists(
                    $permiso,
                    $enviados
                );
        }

        $this->guardarConfiguracionLocal([
            'permisos_coordinador' =>
                $permisosCoordinador,
        ]);

        return redirect('/configuracion/permisos')
            ->with(
                'success',
                'Permisos guardados correctamente.'
            );
    }


    /**
     * Listado de respaldos.
     */
    public function respaldos()
    {
        $respaldos = collect();

        $archivos = Storage::disk('local')
            ->files('respaldos');

        foreach ($archivos as $archivo) {

            $respaldos->push(
                (object) [
                    'id' => md5($archivo),

                    'archivo' => basename($archivo),

                    'fecha' => date(
                        'Y-m-d H:i:s',
                        Storage::disk('local')
                            ->lastModified($archivo)
                    ),

                    'tamano' => $this->formatearBytes(
                        Storage::disk('local')
                            ->size($archivo)
                    ),

                    'usuario' => 'Sistema',

                    'estatus' => 'completo',

                    'ruta' => $archivo,
                ]
            );
        }

        $respaldos = $respaldos
            ->sortByDesc('fecha')
            ->values();

        return view(
            'configuracion.respaldos',
            compact('respaldos')
        );
    }


    /**
     * Crear respaldo básico.
     */
    public function crearRespaldo()
    {
        $nombre =
            'sica-respaldo-'
            . now()->format('Y-m-d-His')
            . '.json';

        $contenido = [
            'sistema' => 'SICA',
            'fecha' => now()->toDateTimeString(),
            'version' => 1,
            'mensaje' =>
                'Respaldo básico generado por SICA.',
        ];

        Storage::disk('local')->put(
            'respaldos/' . $nombre,
            json_encode(
                $contenido,
                JSON_PRETTY_PRINT
                | JSON_UNESCAPED_UNICODE
            )
        );

        return redirect('/configuracion/respaldos')
            ->with(
                'success',
                'Respaldo generado correctamente.'
            );
    }


    /**
     * Descargar respaldo.
     */
    public function descargarRespaldo($id)
    {
        $archivo =
            $this->buscarRespaldoPorId($id);

        abort_if(
            !$archivo,
            404,
            'Respaldo no encontrado.'
        );

        return Storage::disk('local')
            ->download($archivo);
    }


    /**
     * Eliminar respaldo.
     */
    public function eliminarRespaldo($id)
    {
        $archivo =
            $this->buscarRespaldoPorId($id);

        abort_if(
            !$archivo,
            404,
            'Respaldo no encontrado.'
        );

        Storage::disk('local')
            ->delete($archivo);

        return redirect('/configuracion/respaldos')
            ->with(
                'success',
                'Respaldo eliminado correctamente.'
            );
    }


    /**
     * Guardar valores en archivo config/sica.php.
     */
    private function guardarConfiguracionLocal(array $nuevos)
    {
        $ruta = config_path('sica.php');

        $actual = [];

        if (file_exists($ruta)) {
            $actual = require $ruta;
        }

        $configuracion = array_merge(
            $actual,
            $nuevos
        );

        $contenido =
            "<?php\n\nreturn "
            . var_export(
                $configuracion,
                true
            )
            . ";\n";

        file_put_contents(
            $ruta,
            $contenido
        );
    }


    /**
     * Buscar un respaldo por su identificador.
     */
    private function buscarRespaldoPorId($id)
    {
        $archivos = Storage::disk('local')
            ->files('respaldos');

        foreach ($archivos as $archivo) {

            if (md5($archivo) === $id) {
                return $archivo;
            }
        }

        return null;
    }


    /**
     * Convertir bytes a formato legible.
     */
    private function formatearBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            return round(
                $bytes / 1073741824,
                2
            ) . ' GB';
        }

        if ($bytes >= 1048576) {
            return round(
                $bytes / 1048576,
                2
            ) . ' MB';
        }

        if ($bytes >= 1024) {
            return round(
                $bytes / 1024,
                2
            ) . ' KB';
        }

        return $bytes . ' bytes';
    }
}