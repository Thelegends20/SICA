@extends('layouts.sica')

@section('titulo', 'Parámetros')

@section('contenido')

@php

    $config = $parametros ?? null;

    $nombreSistema =
        $config->nombre_sistema
        ?? 'SICA';

    $nombreCompleto =
        $config->nombre_completo
        ?? 'Sistema Integral de Control y Afiliación';

    $organizacion =
        $config->organizacion
        ?? '';

    $telefono =
        $config->telefono
        ?? '';

    $correo =
        $config->correo
        ?? '';

    $direccion =
        $config->direccion
        ?? '';

    $vigenciaAfiliacion =
        $config->vigencia_afiliacion_meses
        ?? 12;

    $vigenciaCredencial =
        $config->vigencia_credencial_meses
        ?? 12;

    $estadoDefault =
        $config->estado_default
        ?? 'Michoacán';

@endphp


<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Parámetros generales</h1>
        <p>Configuración básica para el funcionamiento e identidad de SICA.</p>
    </div>

    <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<form
    method="POST"
    action="{{ url('/configuracion/parametros') }}"
>

    @csrf

    @if($config)
        @method('PUT')
    @endif


    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                    style="width:50px;height:50px;"
                >
                    <i class="bi bi-gear fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Identidad del sistema
                    </h5>

                    <p class="text-muted small mb-0">
                        Nombre e información institucional mostrada dentro de SICA.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-4">

                    <label for="nombre_sistema" class="form-label fw-bold">
                        Nombre corto
                    </label>

                    <input
                        type="text"
                        id="nombre_sistema"
                        name="nombre_sistema"
                        class="form-control @error('nombre_sistema') is-invalid @enderror"
                        value="{{ old('nombre_sistema', $nombreSistema) }}"
                        maxlength="30"
                    >

                    @error('nombre_sistema')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-8">

                    <label for="nombre_completo" class="form-label fw-bold">
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        id="nombre_completo"
                        name="nombre_completo"
                        class="form-control @error('nombre_completo') is-invalid @enderror"
                        value="{{ old('nombre_completo', $nombreCompleto) }}"
                        maxlength="150"
                    >

                    @error('nombre_completo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label for="organizacion" class="form-label fw-bold">
                        Organización
                    </label>

                    <input
                        type="text"
                        id="organizacion"
                        name="organizacion"
                        class="form-control @error('organizacion') is-invalid @enderror"
                        value="{{ old('organizacion', $organizacion) }}"
                        placeholder="Nombre de la organización"
                    >

                    @error('organizacion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                    style="width:50px;height:50px;"
                >
                    <i class="bi bi-building fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Datos de contacto
                    </h5>

                    <p class="text-muted small mb-0">
                        Información institucional utilizada en documentos y consultas.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label for="telefono" class="form-label fw-bold">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        class="form-control @error('telefono') is-invalid @enderror"
                        value="{{ old('telefono', $telefono) }}"
                        placeholder="Teléfono de contacto"
                    >

                    @error('telefono')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="correo" class="form-label fw-bold">
                        Correo
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        class="form-control @error('correo') is-invalid @enderror"
                        value="{{ old('correo', $correo) }}"
                        placeholder="correo@ejemplo.com"
                    >

                    @error('correo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label for="direccion" class="form-label fw-bold">
                        Dirección
                    </label>

                    <textarea
                        id="direccion"
                        name="direccion"
                        rows="3"
                        class="form-control @error('direccion') is-invalid @enderror"
                        placeholder="Domicilio de la organización"
                    >{{ old('direccion', $direccion) }}</textarea>

                    @error('direccion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                    style="width:50px;height:50px;"
                >
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Vigencias
                    </h5>

                    <p class="text-muted small mb-0">
                        Periodos predeterminados para nuevos registros.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-4">

                    <label for="vigencia_afiliacion_meses" class="form-label fw-bold">
                        Vigencia de afiliación
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            id="vigencia_afiliacion_meses"
                            name="vigencia_afiliacion_meses"
                            class="form-control @error('vigencia_afiliacion_meses') is-invalid @enderror"
                            value="{{ old('vigencia_afiliacion_meses', $vigenciaAfiliacion) }}"
                            min="1"
                            max="120"
                        >

                        <span class="input-group-text">
                            meses
                        </span>

                        @error('vigencia_afiliacion_meses')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="col-12 col-md-4">

                    <label for="vigencia_credencial_meses" class="form-label fw-bold">
                        Vigencia de credencial
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            id="vigencia_credencial_meses"
                            name="vigencia_credencial_meses"
                            class="form-control @error('vigencia_credencial_meses') is-invalid @enderror"
                            value="{{ old('vigencia_credencial_meses', $vigenciaCredencial) }}"
                            min="1"
                            max="120"
                        >

                        <span class="input-group-text">
                            meses
                        </span>

                        @error('vigencia_credencial_meses')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="col-12 col-md-4">

                    <label for="estado_default" class="form-label fw-bold">
                        Estado predeterminado
                    </label>

                    <input
                        type="text"
                        id="estado_default"
                        name="estado_default"
                        class="form-control @error('estado_default') is-invalid @enderror"
                        value="{{ old('estado_default', $estadoDefault) }}"
                    >

                    @error('estado_default')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    <div class="card card-sica">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <div class="fw-bold">
                        Guardar parámetros
                    </div>

                    <small class="text-muted">
                        Estos valores se utilizarán como configuración general del sistema.
                    </small>

                </div>


                <div class="d-flex gap-2 flex-wrap">

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
                        Guardar cambios
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection