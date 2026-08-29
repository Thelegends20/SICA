@extends('layouts.sica')

@section('titulo', 'QR del vehículo')

@section('contenido')

@php

    $registro = $vehiculo ?? null;

    $propietario =
        $registro?->afiliado
        ?? $registro?->afiliacion
        ?? null;

@endphp


@if(!$registro)

    <div class="alert alert-danger">
        No se encontró el vehículo.
    </div>

@else

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Verificación QR</h1>
        <p>Identificador interno del vehículo registrado en SICA.</p>
    </div>

    <a
        href="{{ url('/vehiculos/' . $registro->id) }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<div class="row g-4">


    <div class="col-12 col-lg-5">

        <div class="card card-sica h-100">

            <div class="card-body p-4 text-center">

                <div
                    class="mx-auto mb-4 rounded-4 bg-light d-flex align-items-center justify-content-center"
                    style="width:220px;height:220px;"
                >

                    <div>

                        <i
                            class="bi bi-qr-code"
                            style="font-size:8rem;"
                        ></i>

                        <div class="small text-muted mt-2">
                            QR pendiente de generar
                        </div>

                    </div>

                </div>


                <h5 class="fw-bold mb-1">
                    {{ $registro->folio_vehiculo ?? 'Sin folio' }}
                </h5>

                <div class="text-muted mb-4">
                    Identificador interno SICA
                </div>


                <div class="alert alert-light border text-start mb-0">

                    <div class="small text-muted mb-1">
                        Token de verificación
                    </div>

                    <code
                        class="d-block text-break"
                        id="tokenQr"
                    >
                        {{ $registro->token_qr ?? 'Sin token generado' }}
                    </code>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-lg-7">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Datos del vehículo
                </h5>

                <p class="text-muted small mb-0">
                    Información asociada al identificador.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="row g-3">


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
                            Marca
                        </div>

                        <div class="fw-bold">
                            {{ $registro->marca ?? 'No registrada' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
                            Submarca / Modelo
                        </div>

                        <div class="fw-bold">
                            {{ $registro->submarca ?? 'No registrada' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="small text-muted">
                            Año
                        </div>

                        <div class="fw-bold">
                            {{ $registro->anio ?? $registro->año ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="small text-muted">
                            Color
                        </div>

                        <div class="fw-bold">
                            {{ $registro->color ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="small text-muted">
                            Estatus
                        </div>

                        @php

                            $estatus =
                                strtolower(
                                    $registro->estatus
                                    ?? 'inactivo'
                                );

                            $badge = match($estatus) {

                                'activo' => 'success',
                                'inactivo' => 'secondary',
                                'suspendido' => 'warning',
                                'robado' => 'danger',
                                'baja' => 'dark',

                                default => 'secondary',

                            };

                        @endphp

                        <span class="badge text-bg-{{ $badge }}">
                            {{ ucfirst($estatus) }}
                        </span>

                    </div>


                    <div class="col-12">

                        <hr>

                    </div>


                    <div class="col-12">

                        <div class="small text-muted">
                            VIN / Número de serie
                        </div>

                        <div class="fw-bold text-break">
                            {{ $registro->vin ?? $registro->VIN ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
                            Motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->motor ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
                            Serie de motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->serie_motor ?? 'No registrada' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
                            Placas
                        </div>

                        <div class="fw-bold">
                            {{ $registro->placas ?? 'No registradas' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="small text-muted">
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

                </div>

            </div>

        </div>


        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Titular registrado
                </h5>

            </div>


            <div class="card-body p-4">

                @if($propietario)

                    <div class="row g-3">

                        <div class="col-12 col-md-7">

                            <div class="small text-muted">
                                Nombre
                            </div>

                            <div class="fw-bold">
                                {{ $propietario->nombre }}
                            </div>

                        </div>


                        <div class="col-12 col-md-5">

                            <div class="small text-muted">
                                Municipio
                            </div>

                            <div class="fw-bold">
                                {{ $propietario->municipio ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12">

                            <a
                                href="{{ url('/afiliaciones/' . $propietario->id) }}"
                                class="btn btn-outline-success"
                            >
                                <i class="bi bi-person me-2"></i>
                                Ver expediente del afiliado
                            </a>

                        </div>

                    </div>

                @else

                    <div class="alert alert-warning mb-0">
                        No se encontró información del titular.
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


<div class="alert alert-info mt-4">

    <div class="d-flex gap-3">

        <i class="bi bi-info-circle fs-4"></i>

        <div>

            <div class="fw-bold">
                Siguiente etapa del QR
            </div>

            <div class="small">
                Esta pantalla ya deja preparado el vehículo y su token. Después conectaremos el token con un QR real y una página pública de verificación, sin exponer directamente el ID interno del registro.
            </div>

        </div>

    </div>

</div>

@endif

@endsection