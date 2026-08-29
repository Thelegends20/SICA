@extends('layouts.sica')

@section('titulo', 'Respaldos')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Respaldos</h1>
        <p>Control de copias de seguridad y recuperación de información de SICA.</p>
    </div>

    <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<div class="row g-4 mb-4">

    <div class="col-12 col-lg-6">

        <div class="card card-sica h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-start gap-3">

                    <div
                        class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width:54px;height:54px;min-width:54px;"
                    >
                        <i class="bi bi-database-check fs-4"></i>
                    </div>

                    <div class="flex-grow-1">

                        <h5 class="fw-bold mb-1">
                            Crear respaldo
                        </h5>

                        <p class="text-muted">
                            Genera una copia de seguridad de la información almacenada en SICA.
                        </p>

                        <form
                            method="POST"
                            action="{{ url('/configuracion/respaldos/crear') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-sica"
                                onclick="return confirm('¿Deseas generar un nuevo respaldo del sistema?')"
                            >
                                <i class="bi bi-database-add me-2"></i>
                                Generar respaldo
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-lg-6">

        <div class="card card-sica h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-start gap-3">

                    <div
                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                        style="width:54px;height:54px;min-width:54px;"
                    >
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Protección de información
                        </h5>

                        <p class="text-muted mb-0">
                            Los respaldos permiten conservar una copia de los datos críticos antes de realizar cambios importantes en el sistema.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="card card-sica">

    <div class="card-header bg-white border-0 pt-4 px-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Historial de respaldos
                </h5>

                <p class="text-muted small mb-0">
                    Copias de seguridad disponibles.
                </p>

            </div>

            <div class="text-muted small">
                <i class="bi bi-clock-history me-1"></i>
                Historial
            </div>

        </div>

    </div>


    <div class="card-body p-4">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>Archivo</th>
                        <th>Fecha</th>
                        <th>Tamaño</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($respaldos ?? [] as $respaldo)

                        @php

                            $nombreArchivo =
                                $respaldo->archivo
                                ?? $respaldo->nombre
                                ?? 'respaldo-sica';

                            $estadoRespaldo =
                                strtolower(
                                    $respaldo->estatus
                                    ?? $respaldo->estado
                                    ?? 'completo'
                                );

                            $badgeRespaldo = match($estadoRespaldo) {
                                'completo' => 'success',
                                'correcto' => 'success',
                                'pendiente' => 'warning',
                                'error' => 'danger',
                                'fallido' => 'danger',
                                default => 'secondary',
                            };

                        @endphp


                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                        style="width:44px;height:44px;min-width:44px;"
                                    >
                                        <i class="bi bi-file-earmark-zip fs-4 text-secondary"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold">
                                            {{ $nombreArchivo }}
                                        </div>

                                        @if(!empty($respaldo->tipo))

                                            <small class="text-muted">
                                                {{ strtoupper($respaldo->tipo) }}
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td>

                                @if(!empty($respaldo->created_at))

                                    {{ \Carbon\Carbon::parse($respaldo->created_at)->format('d/m/Y H:i') }}

                                @elseif(!empty($respaldo->fecha))

                                    {{ \Carbon\Carbon::parse($respaldo->fecha)->format('d/m/Y H:i') }}

                                @else

                                    <span class="text-muted">
                                        Sin fecha
                                    </span>

                                @endif

                            </td>


                            <td>
                                {{ $respaldo->tamano ?? $respaldo->tamaño ?? 'No disponible' }}
                            </td>


                            <td>
                                {{ $respaldo->usuario->name ?? $respaldo->usuario ?? 'Sistema' }}
                            </td>


                            <td>

                                <span class="badge text-bg-{{ $badgeRespaldo }}">
                                    {{ ucfirst($estadoRespaldo) }}
                                </span>

                            </td>


                            <td class="text-end">

                                <div class="btn-group">

                                    @if(isset($respaldo->id))

                                        <a
                                            href="{{ url('/configuracion/respaldos/' . $respaldo->id . '/descargar') }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Descargar"
                                        >
                                            <i class="bi bi-download"></i>
                                        </a>

                                    @endif


                                    @if(isset($respaldo->id))

                                        <form
                                            method="POST"
                                            action="{{ url('/configuracion/respaldos/' . $respaldo->id . '/eliminar') }}"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este respaldo? Esta acción no se puede deshacer.')"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-database"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay respaldos registrados
                                </h5>

                                <p class="text-muted mb-3">
                                    Aún no se ha generado ninguna copia de seguridad.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="alert alert-warning mt-4">

    <div class="d-flex gap-3">

        <i class="bi bi-exclamation-triangle fs-4"></i>

        <div>

            <div class="fw-bold">
                Recomendación
            </div>

            <div class="small">
                Genera un respaldo antes de cambios importantes en usuarios, estructura de datos, migraciones o configuración del sistema.
            </div>

        </div>

    </div>

</div>

@endsection