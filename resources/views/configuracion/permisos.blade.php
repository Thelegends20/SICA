@extends('layouts.sica')

@section('titulo', 'Permisos')

@section('contenido')

@php

    $permisosActuales = $permisos ?? [];

    $tienePermiso = function ($rol, $permiso) use ($permisosActuales) {

        if (isset($permisosActuales[$rol][$permiso])) {
            return (bool) $permisosActuales[$rol][$permiso];
        }

        if ($rol === 'ADMIN_PRINCIPAL') {
            return true;
        }

        $defaultsCoordinador = [
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
        ];

        return $defaultsCoordinador[$permiso] ?? false;
    };

@endphp


<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Permisos</h1>
        <p>Control de acceso a módulos y funciones según el rol del usuario.</p>
    </div>

    <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<form
    method="POST"
    action="{{ url('/configuracion/permisos') }}"
>

    @csrf
    @method('PUT')


    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                    style="width:50px;height:50px;"
                >
                    <i class="bi bi-shield-check fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Administrador principal
                    </h5>

                    <p class="text-muted small mb-0">
                        Acceso completo a la administración del sistema.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="alert alert-success mb-0">

                <div class="d-flex gap-3">

                    <i class="bi bi-check-circle-fill fs-4"></i>

                    <div>

                        <div class="fw-bold">
                            Acceso total
                        </div>

                        <div class="small">
                            El rol ADMIN_PRINCIPAL conserva acceso a todos los módulos y funciones críticas de SICA.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="card card-sica">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                    style="width:50px;height:50px;"
                >
                    <i class="bi bi-person-lock fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Coordinador
                    </h5>

                    <p class="text-muted small mb-0">
                        Selecciona las funciones disponibles para usuarios con rol COORDINADOR.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>Área</th>
                            <th>Permiso</th>
                            <th class="text-center">Habilitado</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                <i class="bi bi-speedometer2 me-2 text-success"></i>
                                Dashboard
                            </td>

                            <td>
                                Acceder al panel principal
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][dashboard]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'dashboard') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td rowspan="3">
                                <i class="bi bi-people me-2 text-success"></i>
                                Afiliaciones
                            </td>

                            <td>
                                Consultar afiliados
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][afiliaciones_ver]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'afiliaciones_ver') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Crear afiliaciones
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][afiliaciones_crear]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'afiliaciones_crear') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Editar afiliaciones
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][afiliaciones_editar]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'afiliaciones_editar') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td rowspan="3">
                                <i class="bi bi-car-front me-2 text-primary"></i>
                                Vehículos
                            </td>

                            <td>
                                Consultar vehículos
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][vehiculos_ver]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'vehiculos_ver') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Registrar vehículos
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][vehiculos_crear]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'vehiculos_crear') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Editar vehículos
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][vehiculos_editar]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'vehiculos_editar') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td rowspan="2">
                                <i class="bi bi-person-vcard me-2 text-warning"></i>
                                Credenciales
                            </td>

                            <td>
                                Consultar credenciales
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][credenciales_ver]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'credenciales_ver') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Generar credenciales
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][credenciales_crear]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'credenciales_crear') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td rowspan="3">
                                <i class="bi bi-person-gear me-2 text-danger"></i>
                                Usuarios
                            </td>

                            <td>
                                Consultar usuarios
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][usuarios_ver]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'usuarios_ver') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Crear usuarios
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][usuarios_crear]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'usuarios_crear') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                Editar usuarios
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][usuarios_editar]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'usuarios_editar') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                <i class="bi bi-gear me-2 text-secondary"></i>
                                Configuración
                            </td>

                            <td>
                                Acceder a configuración general
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][configuracion]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'configuracion') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>


                        <tr>

                            <td>
                                <i class="bi bi-clock-history me-2 text-dark"></i>
                                Auditoría
                            </td>

                            <td>
                                Consultar historial de actividad
                            </td>

                            <td class="text-center">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permisos[COORDINADOR][auditoria]"
                                    value="1"
                                    {{ $tienePermiso('COORDINADOR', 'auditoria') ? 'checked' : '' }}
                                >

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            <div class="alert alert-warning mt-4">

                <div class="d-flex gap-3">

                    <i class="bi bi-exclamation-triangle fs-4"></i>

                    <div>

                        <div class="fw-bold">
                            Protección administrativa
                        </div>

                        <div class="small">
                            Por defecto, los coordinadores pueden trabajar con afiliaciones, vehículos y credenciales, pero no administrar usuarios, configuración ni auditoría.
                        </div>

                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="{{ url('/configuracion') }}"
                    class="btn btn-outline-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-sica"
                >
                    <i class="bi bi-floppy me-2"></i>
                    Guardar permisos
                </button>

            </div>

        </div>

    </div>

</form>

@endsection