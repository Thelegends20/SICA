@extends('layouts.sica')

@section('titulo', 'Expediente de afiliado')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Expediente de afiliado</h1>
        <p>Consulta general del registro dentro de SICA.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ url('/afiliaciones') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>

        @if(isset($afiliado) && isset($afiliado->id))
            <a
                href="{{ url('/afiliaciones/' . $afiliado->id . '/editar') }}"
                class="btn btn-outline-primary"
            >
                <i class="bi bi-pencil me-2"></i>
                Editar
            </a>
        @endif
    </div>
</div>


@php
    $registro = $afiliado ?? $afiliacion ?? null;

    $estatus = strtolower($registro->estatus ?? 'activo');

    $badge = match($estatus) {
        'activo' => 'success',
        'inactivo' => 'secondary',
        'suspendido' => 'warning',
        'baja' => 'danger',
        default => 'secondary',
    };
@endphp


@if($registro)

<div class="row g-4">

    <div class="col-12 col-xl-8">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width:58px;height:58px;min-width:58px;"
                    >
                        <i class="bi bi-person fs-3"></i>
                    </div>

                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center gap-2 flex-wrap">

                            <h4 class="fw-bold mb-0">
                                {{ $registro->nombre ?? 'Sin nombre' }}
                            </h4>

                            <span class="badge text-bg-{{ $badge }}">
                                {{ ucfirst($estatus) }}
                            </span>

                        </div>

                        <div class="text-muted mt-1">
                            {{ $registro->folio_afiliado ?? 'Folio no asignado' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            CURP
                        </div>

                        <div class="fw-bold">
                            {{ $registro->curp ?? 'No registrada' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            RFC
                        </div>

                        <div class="fw-bold">
                            {{ $registro->rfc ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            INE
                        </div>

                        <div class="fw-bold">
                            {{ $registro->ine ?? 'No registrada' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Teléfono
                        </div>

                        <div class="fw-bold">
                            {{ $registro->telefono ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12">

                        <div class="text-muted small">
                            Correo electrónico
                        </div>

                        <div class="fw-bold">
                            {{ $registro->correo ?? 'No registrado' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-geo-alt fs-4"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Domicilio
                        </h5>

                        <p class="text-muted small mb-0">
                            Ubicación registrada del afiliado.
                        </p>
                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12">

                        <div class="text-muted small">
                            Domicilio
                        </div>

                        <div class="fw-bold">
                            {{ $registro->domicilio ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Municipio
                        </div>

                        <div class="fw-bold">
                            {{ $registro->municipio ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Estado
                        </div>

                        <div class="fw-bold">
                            {{ $registro->estado ?? 'No registrado' }}
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
                            Vehículos vinculados
                        </h5>

                        <p class="text-muted small mb-0">
                            Unidades relacionadas con este afiliado.
                        </p>
                    </div>

                    @if(isset($registro->id))
                        <a
                            href="{{ url('/vehiculos/nuevo?afiliado_id=' . $registro->id) }}"
                            class="btn btn-sm btn-sica"
                        >
                            <i class="bi bi-car-front me-2"></i>
                            Agregar vehículo
                        </a>
                    @endif

                </div>

            </div>


            <div class="card-body p-4">

                @php
                    $vehiculos = $registro->vehiculos ?? collect();
                @endphp

                @forelse($vehiculos as $vehiculo)

                    <div class="border rounded-4 p-3 mb-3">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                            <div>

                                <div class="fw-bold fs-5">
                                    {{ $vehiculo->marca ?? 'Sin marca' }}
                                    {{ $vehiculo->submarca ?? '' }}
                                </div>

                                <div class="text-muted small mt-1">
                                    {{ $vehiculo->folio_vehiculo ?? 'Sin folio' }}
                                </div>

                                <div class="small mt-2">

                                    <span class="me-3">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $vehiculo->anio ?? $vehiculo->año ?? 'Sin año' }}
                                    </span>

                                    <span>
                                        <i class="bi bi-palette me-1"></i>
                                        {{ $vehiculo->color ?? 'Sin color' }}
                                    </span>

                                </div>

                            </div>


                            @if(isset($vehiculo->id))
                                <a
                                    href="{{ url('/vehiculos/' . $vehiculo->id) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-eye me-1"></i>
                                    Ver
                                </a>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="text-center py-4">

                        <div class="fs-1 text-muted mb-3">
                            <i class="bi bi-car-front"></i>
                        </div>

                        <h6 class="fw-bold">
                            Sin vehículos vinculados
                        </h6>

                        <p class="text-muted mb-0">
                            Este afiliado todavía no tiene unidades registradas.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    <div class="col-12 col-xl-4">

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Control de afiliación
                </h5>

                <p class="text-muted small mb-0">
                    Estado actual del expediente.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Folio
                    </div>

                    <div class="fw-bold text-success">
                        {{ $registro->folio_afiliado ?? 'No asignado' }}
                    </div>

                </div>


                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Estatus
                    </div>

                    <div class="mt-1">
                        <span class="badge text-bg-{{ $badge }}">
                            {{ ucfirst($estatus) }}
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
                        Registro
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
                    Operaciones disponibles.
                </p>

            </div>


            <div class="card-body p-4 d-grid gap-2">

                @if(isset($registro->id))

                    <a
                        href="{{ url('/afiliaciones/' . $registro->id . '/editar') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="bi bi-pencil me-2"></i>
                        Editar expediente
                    </a>

                    <a
                        href="{{ url('/vehiculos/nuevo?afiliado_id=' . $registro->id) }}"
                        class="btn btn-outline-success"
                    >
                        <i class="bi bi-car-front me-2"></i>
                        Registrar vehículo
                    </a>

                    <a
                        href="{{ url('/credenciales/crear?afiliado_id=' . $registro->id) }}"
                        class="btn btn-outline-warning"
                    >
                        <i class="bi bi-person-vcard me-2"></i>
                        Generar credencial
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
            No se encontró el afiliado
        </h4>

        <p class="text-muted">
            El expediente solicitado no está disponible.
        </p>

        <a href="{{ url('/afiliaciones') }}" class="btn btn-sica">
            Regresar a afiliados
        </a>

    </div>

</div>

@endif

@endsection