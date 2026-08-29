@extends('layouts.sica')

@section('titulo', 'Expediente del vehículo')

@section('contenido')

@php
    $registro = $vehiculo ?? null;

    $estadoVehiculo = strtolower($registro->estatus ?? 'activo');

    $badgeVehiculo = match($estadoVehiculo) {
        'activo' => 'success',
        'inactivo' => 'secondary',
        'suspendido' => 'warning',
        'robado' => 'danger',
        'baja' => 'dark',
        default => 'secondary',
    };

    $propietario =
        $registro->afiliado
        ?? $registro->afiliacion
        ?? null;
@endphp


<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Expediente del vehículo</h1>
        <p>Consulta completa de la unidad registrada en SICA.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a
            href="{{ url('/vehiculos') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>

        @if(isset($registro->id))
            <a
                href="{{ url('/vehiculos/' . $registro->id . '/editar') }}"
                class="btn btn-outline-primary"
            >
                <i class="bi bi-pencil me-2"></i>
                Editar
            </a>
        @endif

    </div>

</div>


@if($registro)

<div class="row g-4">

    <div class="col-12 col-xl-8">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                        style="width:64px;height:64px;min-width:64px;"
                    >
                        <i class="bi bi-car-front fs-2"></i>
                    </div>

                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center gap-2 flex-wrap">

                            <h4 class="fw-bold mb-0">

                                {{ $registro->marca ?? 'Sin marca' }}

                                {{ $registro->submarca ?? '' }}

                            </h4>

                            <span class="badge text-bg-{{ $badgeVehiculo }}">
                                {{ ucfirst($estadoVehiculo) }}
                            </span>

                        </div>

                        <div class="text-muted mt-1">
                            {{ $registro->folio_vehiculo ?? 'Folio no asignado' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Año
                        </div>

                        <div class="fw-bold">
                            {{ $registro->anio ?? $registro->año ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Color
                        </div>

                        <div class="fw-bold">
                            {{ $registro->color ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Placas
                        </div>

                        <div class="fw-bold">
                            {{ $registro->placas ?? 'No registradas' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-upc-scan fs-4"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Identificación de la unidad
                        </h5>

                        <p class="text-muted small mb-0">
                            Números de serie y datos técnicos.
                        </p>
                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12">

                        <div class="text-muted small">
                            VIN / Número de serie
                        </div>

                        <div class="fw-bold font-monospace fs-5">
                            {{ $registro->vin ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->motor ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Serie de motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->serie_motor ?? 'No registrada' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Propietario / Afiliado
                        </h5>

                        <p class="text-muted small mb-0">
                            Persona vinculada a esta unidad.
                        </p>

                    </div>

                    @if(isset($propietario->id))

                        <a
                            href="{{ url('/afiliaciones/' . $propietario->id) }}"
                            class="btn btn-sm btn-outline-success"
                        >
                            <i class="bi bi-person me-2"></i>
                            Ver afiliado
                        </a>

                    @endif

                </div>

            </div>


            <div class="card-body p-4">

                @if($propietario)

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                            style="width:56px;height:56px;min-width:56px;"
                        >
                            <i class="bi bi-person fs-3"></i>
                        </div>

                        <div>

                            <div class="fw-bold fs-5">
                                {{ $propietario->nombre ?? 'Sin nombre' }}
                            </div>

                            <div class="text-muted">
                                {{ $propietario->folio_afiliado ?? 'Sin folio' }}
                            </div>

                            @if(!empty($propietario->telefono))
                                <div class="small mt-1">
                                    <i class="bi bi-telephone me-1"></i>
                                    {{ $propietario->telefono }}
                                </div>
                            @endif

                        </div>

                    </div>

                @else

                    <div class="text-center py-4">

                        <div class="fs-1 text-muted mb-3">
                            <i class="bi bi-person-x"></i>
                        </div>

                        <h6 class="fw-bold">
                            Sin afiliado vinculado
                        </h6>

                        <p class="text-muted mb-0">
                            No se encontró información del propietario.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-qr-code fs-4"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Identificación SICA
                        </h5>

                        <p class="text-muted small mb-0">
                            Datos internos de control y verificación.
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Folio del vehículo
                        </div>

                        <div class="fw-bold text-success">
                            {{ $registro->folio_vehiculo ?? 'No asignado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Token QR
                        </div>

                        @if(!empty($registro->token_qr))

                            <div
                                class="font-monospace text-break"
                                style="font-size:13px;"
                            >
                                {{ $registro->token_qr }}
                            </div>

                        @else

                            <div class="text-muted">
                                No generado
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-xl-4">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Estado de la unidad
                </h5>

                <p class="text-muted small mb-0">
                    Control operativo actual.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Estatus
                    </div>

                    <div class="mt-1">

                        <span class="badge text-bg-{{ $badgeVehiculo }}">
                            {{ ucfirst($estadoVehiculo) }}
                        </span>

                    </div>

                </div>


                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Vigencia
                    </div>

                    <div class="fw-bold">

                        @if(!empty($registro->vigencia))

                            {{ \Carbon\Carbon::parse($registro->vigencia)->format('d/m/Y') }}

                        @else

                            No registrada

                        @endif

                    </div>

                </div>


                <div class="py-3">

                    <div class="text-muted small">
                        Fecha de registro
                    </div>

                    <div class="fw-bold">

                        @if(!empty($registro->created_at))

                            {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y H:i') }}

                        @else

                            Sin información

                        @endif

                    </div>

                </div>

            </div>

        </div>


        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Acciones
                </h5>

                <p class="text-muted small mb-0">
                    Herramientas disponibles para esta unidad.
                </p>

            </div>


            <div class="card-body p-4 d-grid gap-2">

                @if(isset($registro->id))

                    <a
                        href="{{ url('/vehiculos/' . $registro->id . '/editar') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="bi bi-pencil me-2"></i>
                        Editar vehículo
                    </a>

                    <a
                        href="{{ url('/vehiculos/' . $registro->id . '/qr') }}"
                        class="btn btn-outline-success"
                    >
                        <i class="bi bi-qr-code me-2"></i>
                        Ver QR
                    </a>

                @endif


                @if(isset($propietario->id))

                    <a
                        href="{{ url('/afiliaciones/' . $propietario->id) }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-person me-2"></i>
                        Ver expediente del afiliado
                    </a>

                @endif

            </div>

        </div>

    </div>

</div>


@else

<div class="card card-sica">

    <div class="card-body text-center py-5">

        <div class="fs-1 text-danger mb-3">
            <i class="bi bi-exclamation-triangle"></i>
        </div>

        <h4 class="fw-bold">
            Vehículo no encontrado
        </h4>

        <p class="text-muted">
            No se encontró la unidad solicitada.
        </p>

        <a
            href="{{ url('/vehiculos') }}"
            class="btn btn-sica"
        >
            Regresar a vehículos
        </a>

    </div>

</div>

@endif

@endsection