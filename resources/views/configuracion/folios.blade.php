@extends('layouts.sica')

@section('titulo', 'Folios')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Control de folios</h1>
        <p>Configuración y seguimiento de las series internas utilizadas por SICA.</p>
    </div>

    <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


@php

    $configFolios = $folios ?? null;

    $afiliadoPrefijo =
        $configFolios->prefijo_afiliado
        ?? 'SICA-A';

    $vehiculoPrefijo =
        $configFolios->prefijo_vehiculo
        ?? 'SICA-V';

    $credencialPrefijo =
        $configFolios->prefijo_credencial
        ?? 'SICA-C';

    $siguienteAfiliado =
        $configFolios->siguiente_afiliado
        ?? 1;

    $siguienteVehiculo =
        $configFolios->siguiente_vehiculo
        ?? 1;

    $siguienteCredencial =
        $configFolios->siguiente_credencial
        ?? 1;

@endphp


<div class="row g-4 mb-4">

    <div class="col-12 col-md-6 col-xl-4">

        <div class="card card-sica h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-start justify-content-between gap-3">

                    <div>

                        <div class="text-muted small mb-1">
                            Próximo folio de afiliado
                        </div>

                        <div class="fs-4 fw-bold text-success">
                            {{ $afiliadoPrefijo }}-{{ now()->format('Y') }}-{{ str_pad($siguienteAfiliado, 6, '0', STR_PAD_LEFT) }}
                        </div>

                    </div>

                    <div
                        class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;min-width:48px;"
                    >
                        <i class="bi bi-person-vcard fs-4"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <div class="card card-sica h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-start justify-content-between gap-3">

                    <div>

                        <div class="text-muted small mb-1">
                            Próximo folio de vehículo
                        </div>

                        <div class="fs-4 fw-bold text-primary">
                            {{ $vehiculoPrefijo }}-{{ now()->format('Y') }}-{{ str_pad($siguienteVehiculo, 6, '0', STR_PAD_LEFT) }}
                        </div>

                    </div>

                    <div
                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;min-width:48px;"
                    >
                        <i class="bi bi-car-front fs-4"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <div class="card card-sica h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-start justify-content-between gap-3">

                    <div>

                        <div class="text-muted small mb-1">
                            Próximo folio de credencial
                        </div>

                        <div class="fs-4 fw-bold text-warning">
                            {{ $credencialPrefijo }}-{{ now()->format('Y') }}-{{ str_pad($siguienteCredencial, 6, '0', STR_PAD_LEFT) }}
                        </div>

                    </div>

                    <div
                        class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;min-width:48px;"
                    >
                        <i class="bi bi-upc-scan fs-4"></i>
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
                class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                style="width:50px;height:50px;"
            >
                <i class="bi bi-sliders fs-4"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">
                    Configuración de series
                </h5>

                <p class="text-muted small mb-0">
                    Define los prefijos y números consecutivos de cada tipo de registro.
                </p>
            </div>

        </div>

    </div>


    <div class="card-body p-4">

        <form
            method="POST"
            action="{{ url('/configuracion/folios') }}"
        >

            @csrf

            @if(isset($configFolios))
                @method('PUT')
            @endif


            <div class="row g-4">

                <div class="col-12">

                    <h6 class="fw-bold border-bottom pb-2">
                        Afiliaciones
                    </h6>

                </div>


                <div class="col-12 col-md-6">

                    <label for="prefijo_afiliado" class="form-label fw-bold">
                        Prefijo
                    </label>

                    <input
                        type="text"
                        id="prefijo_afiliado"
                        name="prefijo_afiliado"
                        class="form-control @error('prefijo_afiliado') is-invalid @enderror"
                        value="{{ old('prefijo_afiliado', $afiliadoPrefijo) }}"
                        placeholder="SICA-A"
                        maxlength="20"
                    >

                    @error('prefijo_afiliado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="siguiente_afiliado" class="form-label fw-bold">
                        Siguiente consecutivo
                    </label>

                    <input
                        type="number"
                        id="siguiente_afiliado"
                        name="siguiente_afiliado"
                        class="form-control @error('siguiente_afiliado') is-invalid @enderror"
                        value="{{ old('siguiente_afiliado', $siguienteAfiliado) }}"
                        min="1"
                    >

                    @error('siguiente_afiliado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <h6 class="fw-bold border-bottom pb-2 mt-2">
                        Vehículos
                    </h6>

                </div>


                <div class="col-12 col-md-6">

                    <label for="prefijo_vehiculo" class="form-label fw-bold">
                        Prefijo
                    </label>

                    <input
                        type="text"
                        id="prefijo_vehiculo"
                        name="prefijo_vehiculo"
                        class="form-control @error('prefijo_vehiculo') is-invalid @enderror"
                        value="{{ old('prefijo_vehiculo', $vehiculoPrefijo) }}"
                        placeholder="SICA-V"
                        maxlength="20"
                    >

                    @error('prefijo_vehiculo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="siguiente_vehiculo" class="form-label fw-bold">
                        Siguiente consecutivo
                    </label>

                    <input
                        type="number"
                        id="siguiente_vehiculo"
                        name="siguiente_vehiculo"
                        class="form-control @error('siguiente_vehiculo') is-invalid @enderror"
                        value="{{ old('siguiente_vehiculo', $siguienteVehiculo) }}"
                        min="1"
                    >

                    @error('siguiente_vehiculo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <h6 class="fw-bold border-bottom pb-2 mt-2">
                        Credenciales
                    </h6>

                </div>


                <div class="col-12 col-md-6">

                    <label for="prefijo_credencial" class="form-label fw-bold">
                        Prefijo
                    </label>

                    <input
                        type="text"
                        id="prefijo_credencial"
                        name="prefijo_credencial"
                        class="form-control @error('prefijo_credencial') is-invalid @enderror"
                        value="{{ old('prefijo_credencial', $credencialPrefijo) }}"
                        placeholder="SICA-C"
                        maxlength="20"
                    >

                    @error('prefijo_credencial')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="siguiente_credencial" class="form-label fw-bold">
                        Siguiente consecutivo
                    </label>

                    <input
                        type="number"
                        id="siguiente_credencial"
                        name="siguiente_credencial"
                        class="form-control @error('siguiente_credencial') is-invalid @enderror"
                        value="{{ old('siguiente_credencial', $siguienteCredencial) }}"
                        min="1"
                    >

                    @error('siguiente_credencial')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <div class="alert alert-warning mb-0">

                        <div class="d-flex gap-3">

                            <i class="bi bi-exclamation-triangle fs-4"></i>

                            <div>

                                <div class="fw-bold">
                                    Importante
                                </div>

                                <div class="small">
                                    No reduzcas un consecutivo por debajo de un número que ya haya sido utilizado. Los folios deben permanecer únicos.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-12">

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
                            Guardar configuración
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection