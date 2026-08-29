@extends('layouts.sica')

@section('titulo', 'Editar vehículo')

@section('contenido')

@php
    $registro = $vehiculo ?? null;
@endphp

@if(!$registro)

    <div class="alert alert-danger">
        No se encontró el vehículo.
    </div>

@else

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Editar vehículo</h1>
        <p>Actualiza la información del vehículo registrado en SICA.</p>
    </div>

    <a
        href="{{ url('/vehiculos/' . $registro->id) }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <form
            method="POST"
            action="{{ url('/vehiculos/' . $registro->id) }}"
        >

            @csrf
            @method('PUT')


            <div class="row g-3">


                <div class="col-12">

                    <label for="afiliado_id" class="form-label fw-bold">
                        Afiliado propietario *
                    </label>

                    <select
                        id="afiliado_id"
                        name="afiliado_id"
                        class="form-select @error('afiliado_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Selecciona un afiliado
                        </option>

                        @foreach($afiliados ?? [] as $afiliado)

                            <option
                                value="{{ $afiliado->id }}"
                                {{
                                    (string) old(
                                        'afiliado_id',
                                        $registro->afiliado_id
                                    ) === (string) $afiliado->id
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                {{ $afiliado->nombre }}

                                @if(!empty($afiliado->folio_afiliado))
                                    | {{ $afiliado->folio_afiliado }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('afiliado_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="marca" class="form-label fw-bold">
                        Marca *
                    </label>

                    <input
                        type="text"
                        id="marca"
                        name="marca"
                        class="form-control @error('marca') is-invalid @enderror"
                        value="{{ old('marca', $registro->marca) }}"
                        required
                    >

                    @error('marca')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="submarca" class="form-label fw-bold">
                        Submarca / Modelo
                    </label>

                    <input
                        type="text"
                        id="submarca"
                        name="submarca"
                        class="form-control @error('submarca') is-invalid @enderror"
                        value="{{ old('submarca', $registro->submarca) }}"
                    >

                    @error('submarca')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label for="anio" class="form-label fw-bold">
                        Año
                    </label>

                    <input
                        type="number"
                        id="anio"
                        name="anio"
                        class="form-control @error('anio') is-invalid @enderror"
                        value="{{ old('anio', $registro->anio ?? $registro->año ?? '') }}"
                        min="1900"
                        max="{{ now()->year + 1 }}"
                    >

                    @error('anio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label for="color" class="form-label fw-bold">
                        Color
                    </label>

                    <input
                        type="text"
                        id="color"
                        name="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{ old('color', $registro->color) }}"
                    >

                    @error('color')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label for="placas" class="form-label fw-bold">
                        Placas
                    </label>

                    <input
                        type="text"
                        id="placas"
                        name="placas"
                        class="form-control @error('placas') is-invalid @enderror"
                        value="{{ old('placas', $registro->placas) }}"
                    >

                    @error('placas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label for="vin" class="form-label fw-bold">
                        VIN / Número de serie *
                    </label>

                    <input
                        type="text"
                        id="vin"
                        name="vin"
                        class="form-control text-uppercase @error('vin') is-invalid @enderror"
                        value="{{ old('vin', $registro->vin ?? $registro->VIN ?? '') }}"
                        maxlength="17"
                        required
                    >

                    @error('vin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="motor" class="form-label fw-bold">
                        Motor
                    </label>

                    <input
                        type="text"
                        id="motor"
                        name="motor"
                        class="form-control @error('motor') is-invalid @enderror"
                        value="{{ old('motor', $registro->motor) }}"
                    >

                    @error('motor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="serie_motor" class="form-label fw-bold">
                        Serie de motor
                    </label>

                    <input
                        type="text"
                        id="serie_motor"
                        name="serie_motor"
                        class="form-control @error('serie_motor') is-invalid @enderror"
                        value="{{ old('serie_motor', $registro->serie_motor) }}"
                    >

                    @error('serie_motor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="estatus" class="form-label fw-bold">
                        Estatus *
                    </label>

                    <select
                        id="estatus"
                        name="estatus"
                        class="form-select @error('estatus') is-invalid @enderror"
                        required
                    >

                        @foreach([
                            'activo' => 'Activo',
                            'inactivo' => 'Inactivo',
                            'suspendido' => 'Suspendido',
                            'robado' => 'Reportado como robado',
                            'baja' => 'Baja',
                        ] as $valor => $texto)

                            <option
                                value="{{ $valor }}"
                                {{
                                    old(
                                        'estatus',
                                        $registro->estatus
                                    ) === $valor
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                {{ $texto }}
                            </option>

                        @endforeach

                    </select>

                    @error('estatus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="vigencia" class="form-label fw-bold">
                        Vigencia
                    </label>

                    <input
                        type="date"
                        id="vigencia"
                        name="vigencia"
                        class="form-control @error('vigencia') is-invalid @enderror"
                        value="{{ old(
                            'vigencia',
                            !empty($registro->vigencia)
                                ? \Carbon\Carbon::parse($registro->vigencia)->format('Y-m-d')
                                : ''
                        ) }}"
                    >

                    @error('vigencia')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <div class="alert alert-light border mb-0">

                                <div class="small text-muted">
                                    Folio interno SICA
                                </div>

                                <div class="fw-bold">
                                    {{ $registro->folio_vehiculo ?? 'Sin folio' }}
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="alert alert-light border mb-0">

                                <div class="small text-muted">
                                    Token de verificación
                                </div>

                                <div
                                    class="fw-bold text-break"
                                    style="font-size:.85rem;"
                                >
                                    {{ $registro->token_qr ?? 'Sin token' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-12">

                    <hr>

                    <div class="d-flex justify-content-end gap-2 flex-wrap">

                        <a
                            href="{{ url('/vehiculos/' . $registro->id) }}"
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

        </form>

    </div>

</div>

@endif

@endsection