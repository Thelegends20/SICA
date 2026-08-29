@extends('layouts.sica')

@section('titulo', 'Credencial')

@section('contenido')

@php
    $registro = $credencial ?? null;

    $afiliado =
        $registro->afiliado
        ?? $registro->afiliacion
        ?? null;

    $estadoCredencial =
        strtolower(
            $registro->estatus
            ?? $registro->estado
            ?? 'activa'
        );

    if (
        $registro
        && !empty($registro->vigencia)
        && \Carbon\Carbon::parse($registro->vigencia)->isPast()
        && $estadoCredencial === 'activa'
    ) {
        $estadoCredencial = 'vencida';
    }

    $badgeCredencial = match($estadoCredencial) {
        'activa' => 'success',
        'vencida' => 'warning',
        'cancelada' => 'danger',
        default => 'secondary',
    };
@endphp


<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Credencial de afiliación</h1>
        <p>Consulta de la identificación emitida dentro de SICA.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a
            href="{{ url('/credenciales') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>

        @if(isset($registro->id))

            <a
                href="{{ url('/credenciales/' . $registro->id . '/imprimir') }}"
                class="btn btn-sica"
            >
                <i class="bi bi-printer me-2"></i>
                Imprimir
            </a>

        @endif

    </div>

</div>


@if($registro)

<div class="row g-4">

    <div class="col-12 col-xl-8">

        <div class="card card-sica">

            <div class="card-body p-4 p-md-5">

                <div
                    class="border rounded-4 overflow-hidden"
                    style="max-width:760px;margin:auto;"
                >

                    <div
                        class="p-4 text-white"
                        style="background:linear-gradient(135deg,#0f5132,#198754);"
                    >

                        <div class="d-flex justify-content-between align-items-start gap-3">

                            <div>

                                <div class="small opacity-75">
                                    Sistema Integral de Control y Afiliación
                                </div>

                                <h2 class="fw-bold mb-0">
                                    SICA
                                </h2>

                            </div>


                            <div class="text-end">

                                <i class="bi bi-shield-check fs-1"></i>

                            </div>

                        </div>

                    </div>


                    <div class="p-4 bg-white">

                        <div class="row g-4 align-items-center">

                            <div class="col-12 col-md-4 text-center">

                                <div
                                    class="rounded-4 border bg-light d-flex align-items-center justify-content-center mx-auto"
                                    style="width:160px;height:190px;"
                                >
                                    <i class="bi bi-person fs-1 text-secondary"></i>
                                </div>

                            </div>


                            <div class="col-12 col-md-8">

                                <div class="mb-3">

                                    <div class="text-muted small">
                                        Nombre
                                    </div>

                                    <div class="fs-4 fw-bold">
                                        {{ $afiliado->nombre ?? $registro->nombre ?? 'Sin nombre' }}
                                    </div>

                                </div>


                                <div class="row g-3">

                                    <div class="col-12 col-sm-6">

                                        <div class="text-muted small">
                                            Folio
                                        </div>

                                        <div class="fw-bold text-success">
                                            {{ $registro->folio_credencial ?? 'Sin folio' }}
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-6">

                                        <div class="text-muted small">
                                            Estado
                                        </div>

                                        <span class="badge text-bg-{{ $badgeCredencial }}">
                                            {{ ucfirst($estadoCredencial) }}
                                        </span>

                                    </div>


                                    <div class="col-12 col-sm-6">

                                        <div class="text-muted small">
                                            CURP
                                        </div>

                                        <div class="fw-bold">
                                            {{ $afiliado->curp ?? $registro->curp ?? 'No registrada' }}
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-6">

                                        <div class="text-muted small">
                                            Municipio
                                        </div>

                                        <div class="fw-bold">
                                            {{ $afiliado->municipio ?? $registro->municipio ?? 'No registrado' }}
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-6">

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


                                    <div class="col-12 col-sm-6">

                                        <div class="text-muted small">
                                            Emisión
                                        </div>

                                        <div class="fw-bold">

                                            @if(!empty($registro->created_at))

                                                {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y') }}

                                            @else

                                                Sin fecha

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="border-top p-3 bg-light text-center">

                        <small class="text-muted">
                            La presente acredita al portador como miembro activo de esta organización.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-xl-4">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Información de control
                </h5>

                <p class="text-muted small mb-0">
                    Datos internos de la credencial.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Folio de credencial
                    </div>

                    <div class="fw-bold text-success">
                        {{ $registro->folio_credencial ?? 'No asignado' }}
                    </div>

                </div>


                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Estado
                    </div>

                    <div class="mt-1">

                        <span class="badge text-bg-{{ $badgeCredencial }}">
                            {{ ucfirst($estadoCredencial) }}
                        </span>

                    </div>

                </div>


                <div class="py-3">

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

            </div>

        </div>


        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Acciones
                </h5>

                <p class="text-muted small mb-0">
                    Operaciones disponibles.
                </p>

            </div>


            <div class="card-body p-4 d-grid gap-2">

                @if(isset($registro->id))

                    <a
                        href="{{ url('/credenciales/' . $registro->id . '/imprimir') }}"
                        class="btn btn-outline-success"
                    >
                        <i class="bi bi-printer me-2"></i>
                        Imprimir credencial
                    </a>

                @endif


                @if(isset($afiliado->id))

                    <a
                        href="{{ url('/afiliaciones/' . $afiliado->id) }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="bi bi-person me-2"></i>
                        Ver afiliado
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
            Credencial no encontrada
        </h4>

        <p class="text-muted">
            No se encontró la credencial solicitada.
        </p>

        <a
            href="{{ url('/credenciales') }}"
            class="btn btn-sica"
        >
            Regresar a credenciales
        </a>

    </div>

</div>

@endif

@endsection