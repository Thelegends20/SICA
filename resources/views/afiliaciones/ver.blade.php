@extends('layouts.sica')

@section('titulo', 'Expediente del afiliado')

@section('contenido')

@php
    $registro = $afiliado ?? $afiliacion ?? null;

    $vehiculos = $registro?->vehiculos ?? collect();

    $credenciales = $registro?->credenciales ?? collect();

    $credencialActiva = $credenciales
        ->sortByDesc('id')
        ->first();

    $estatus = strtoupper($registro->estatus ?? 'SIN ESTATUS');
@endphp


@if(!$registro)

    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i>
        No se encontró el expediente solicitado.
    </div>

@else

    {{-- CABECERA DEL EXPEDIENTE --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">

        <div>
            <h4 class="mb-1 fw-bold">
                {{ $registro->nombre }}
            </h4>

            <div class="text-muted small">
                Expediente SICA

                @if(!empty($registro->folio_afiliado))
                    · {{ $registro->folio_afiliado }}
                @endif
            </div>
        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ url('/afiliaciones') }}"
                class="btn btn-sm btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Volver
            </a>

            <a
                href="{{ url('/afiliaciones/' . $registro->id . '/editar') }}"
                class="btn btn-sm btn-outline-success"
            >
                <i class="bi bi-pencil-square me-1"></i>
                Editar
            </a>

        </div>

    </div>


    {{-- RESUMEN COMPACTO --}}
    <div class="row g-2 mb-3">

        <div class="col-6 col-md-3">

            <div class="card card-sica h-100">
                <div class="card-body py-3">

                    <div class="small text-muted">
                        Estatus
                    </div>

                    <div class="fw-bold mt-1">

                        @if(in_array(strtolower($registro->estatus ?? ''), ['vigente', 'activo', 'activa']))

                            <span class="text-success">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                {{ $estatus }}
                            </span>

                        @elseif(in_array(strtolower($registro->estatus ?? ''), ['suspendido', 'suspendida']))

                            <span class="text-warning">
                                <i class="bi bi-pause-circle-fill me-1"></i>
                                {{ $estatus }}
                            </span>

                        @else

                            <span class="text-secondary">
                                {{ $estatus }}
                            </span>

                        @endif

                    </div>

                </div>
            </div>

        </div>


        <div class="col-6 col-md-3">

            <div class="card card-sica h-100">
                <div class="card-body py-3">

                    <div class="small text-muted">
                        Vigencia
                    </div>

                    <div class="fw-bold mt-1">

                        @if(!empty($registro->vigencia))

                            {{ \Carbon\Carbon::parse($registro->vigencia)->format('d/m/Y') }}

                        @else

                            Sin definir

                        @endif

                    </div>

                </div>
            </div>

        </div>


        <div class="col-6 col-md-3">

            <div class="card card-sica h-100">
                <div class="card-body py-3">

                    <div class="small text-muted">
                        Vehículos
                    </div>

                    <div class="fw-bold fs-5">
                        {{ $vehiculos->count() }}
                    </div>

                </div>
            </div>

        </div>


        <div class="col-6 col-md-3">

            <div class="card card-sica h-100">
                <div class="card-body py-3">

                    <div class="small text-muted">
                        Credencial
                    </div>

                    <div class="fw-bold mt-1">

                        @if($credencialActiva)

                            <span class="text-success">
                                <i class="bi bi-person-vcard me-1"></i>
                                Registrada
                            </span>

                        @else

                            <span class="text-muted">
                                Sin generar
                            </span>

                        @endif

                    </div>

                </div>
            </div>

        </div>

    </div>


    {{-- DATOS PERSONALES --}}
    <div class="card card-sica mb-3">

        <div class="card-header bg-white py-3">

            <div class="fw-bold">
                <i class="bi bi-person-lines-fill text-success me-2"></i>
                Datos del afiliado
            </div>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- FOTOGRAFÍA --}}
                <div class="col-12 col-md-auto">

                    <div
                        class="border rounded-4 bg-light overflow-hidden d-flex align-items-center justify-content-center"
                        style="width:150px;height:180px;"
                    >

                        @if(!empty($registro->foto))

                            <img
                                src="{{ asset('storage/' . $registro->foto) }}"
                                alt="Fotografía de {{ $registro->nombre }}"
                                style="
                                    width:100%;
                                    height:100%;
                                    object-fit:cover;
                                "
                            >

                        @else

                            <div class="text-center text-secondary px-3">

                                <i class="bi bi-person-bounding-box fs-1"></i>

                                <div class="small mt-2">
                                    Sin fotografía
                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- INFORMACIÓN --}}
                <div class="col">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <div class="small text-muted">
                                Nombre completo
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->nombre ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-3">

                            <div class="small text-muted">
                                Teléfono
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->telefono ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-3">

                            <div class="small text-muted">
                                INE
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->ine ?? 'No registrada' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="small text-muted">
                                CURP
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->curp ?? 'No registrada' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="small text-muted">
                                RFC
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->rfc ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="small text-muted">
                                Correo
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->correo ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="small text-muted">
                                Domicilio
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->domicilio ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-3">

                            <div class="small text-muted">
                                Municipio
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->municipio ?? 'No registrado' }}
                            </div>

                        </div>


                        <div class="col-12 col-md-3">

                            <div class="small text-muted">
                                Estado
                            </div>

                            <div class="fw-semibold">
                                {{ $registro->estado ?? 'No registrado' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- VEHÍCULOS DEL EXPEDIENTE --}}
    <div class="card card-sica mb-3">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center gap-2">

                <div class="fw-bold">
                    <i class="bi bi-car-front-fill text-success me-2"></i>
                    Vehículos
                </div>

                <a
                    href="{{ url('/vehiculos/nuevo?afiliado_id=' . $registro->id) }}"
                    class="btn btn-sm btn-sica"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Agregar vehículo
                </a>

            </div>

        </div>


        <div class="card-body p-0">

            @forelse($vehiculos as $vehiculo)

                <div class="p-3 border-bottom">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                        <div>

                            <div class="fw-bold">
                                {{ $vehiculo->marca ?? '' }}
                                {{ $vehiculo->submarca ?? '' }}
                            </div>

                            <div class="small text-muted mt-1">

                                @if(!empty($vehiculo->modelo))
                                    Modelo {{ $vehiculo->modelo }}
                                @endif

                                @if(!empty($vehiculo->anio))
                                    · Año {{ $vehiculo->anio }}
                                @endif

                                @if(!empty($vehiculo->color))
                                    · {{ $vehiculo->color }}
                                @endif

                            </div>

                            <div class="small mt-1">

                                <span class="text-muted">
                                    VIN:
                                </span>

                                {{ $vehiculo->vin ?? 'Sin registrar' }}

                            </div>

                        </div>


                        <div class="text-end">

                            <div class="mb-2">

                                @if(in_array(strtolower($vehiculo->estatus ?? ''), ['vigente', 'activo', 'activa']))

                                    <span class="badge text-bg-success">
                                        {{ strtoupper($vehiculo->estatus) }}
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        {{ strtoupper($vehiculo->estatus ?? 'SIN ESTATUS') }}
                                    </span>

                                @endif

                            </div>

                            <a
                                href="{{ url('/vehiculos/' . $vehiculo->id) }}"
                                class="btn btn-sm btn-outline-success"
                            >
                                Ver vehículo
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="p-4 text-center text-muted">

                    <i class="bi bi-car-front fs-3 d-block mb-2"></i>

                    Este afiliado todavía no tiene vehículos registrados.

                </div>

            @endforelse

        </div>

    </div>


    {{-- CREDENCIAL DEL EXPEDIENTE --}}
    <div class="card card-sica">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center gap-2">

                <div class="fw-bold">
                    <i class="bi bi-person-vcard-fill text-success me-2"></i>
                    Credencial
                </div>

                @if(!$credencialActiva)

                    <a
                        href="{{ url('/credenciales/crear?afiliado_id=' . $registro->id) }}"
                        class="btn btn-sm btn-sica"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Generar credencial
                    </a>

                @endif

            </div>

        </div>


        <div class="card-body">

            @if($credencialActiva)

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>

                        <div class="small text-muted">
                            Credencial vigente del expediente
                        </div>

                        <div class="fw-bold mt-1">
                            {{ $credencialActiva->folio_credencial ?? 'Credencial SICA' }}
                        </div>

                        <div class="small text-muted mt-1">

                            Vigencia:

                            @if(!empty($credencialActiva->vigencia))

                                {{ \Carbon\Carbon::parse($credencialActiva->vigencia)->format('d/m/Y') }}

                            @else

                                Sin definir

                            @endif

                        </div>

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ url('/credenciales/' . $credencialActiva->id) }}"
                            class="btn btn-sm btn-outline-success"
                        >
                            <i class="bi bi-eye me-1"></i>
                            Ver
                        </a>

                        <a
                            href="{{ url('/credenciales/' . $credencialActiva->id . '/imprimir') }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            <i class="bi bi-printer me-1"></i>
                            Imprimir
                        </a>

                    </div>

                </div>

            @else

                <div class="text-center text-muted py-3">

                    <i class="bi bi-person-vcard fs-3 d-block mb-2"></i>

                    Este afiliado todavía no tiene credencial.

                </div>

            @endif

        </div>

    </div>

@endif

@endsection