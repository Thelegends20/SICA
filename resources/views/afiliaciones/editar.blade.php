@extends('layouts.sica')

@section('titulo', 'Editar afiliado')

@section('contenido')

@php
    $registro = $afiliado ?? $afiliacion ?? null;
@endphp

@if(!$registro)

    <div class="alert alert-danger">
        No se encontró la afiliación.
    </div>

@else

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Editar afiliado</h1>
        <p>Actualiza la información del expediente.</p>
    </div>

    <a
        href="{{ url('/afiliaciones/' . $registro->id) }}"
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
            action="{{ url('/afiliaciones/' . $registro->id) }}"
        >

            @csrf
            @method('PUT')


            <div class="row g-3">


                <div class="col-12">

                    <label
                        for="nombre"
                        class="form-label fw-bold"
                    >
                        Nombre completo *
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $registro->nombre) }}"
                        required
                    >

                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="curp"
                        class="form-label fw-bold"
                    >
                        CURP
                    </label>

                    <input
                        type="text"
                        id="curp"
                        name="curp"
                        class="form-control @error('curp') is-invalid @enderror"
                        value="{{ old('curp', $registro->curp) }}"
                        maxlength="18"
                    >

                    @error('curp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="rfc"
                        class="form-label fw-bold"
                    >
                        RFC
                    </label>

                    <input
                        type="text"
                        id="rfc"
                        name="rfc"
                        class="form-control @error('rfc') is-invalid @enderror"
                        value="{{ old('rfc', $registro->rfc) }}"
                        maxlength="13"
                    >

                    @error('rfc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="ine"
                        class="form-label fw-bold"
                    >
                        INE
                    </label>

                    <input
                        type="text"
                        id="ine"
                        name="ine"
                        class="form-control @error('ine') is-invalid @enderror"
                        value="{{ old('ine', $registro->ine) }}"
                    >

                    @error('ine')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="telefono"
                        class="form-label fw-bold"
                    >
                        Teléfono
                    </label>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        class="form-control @error('telefono') is-invalid @enderror"
                        value="{{ old('telefono', $registro->telefono) }}"
                    >

                    @error('telefono')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="correo"
                        class="form-label fw-bold"
                    >
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        class="form-control @error('correo') is-invalid @enderror"
                        value="{{ old('correo', $registro->correo) }}"
                    >

                    @error('correo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="municipio"
                        class="form-label fw-bold"
                    >
                        Municipio
                    </label>

                    <input
                        type="text"
                        id="municipio"
                        name="municipio"
                        class="form-control @error('municipio') is-invalid @enderror"
                        value="{{ old('municipio', $registro->municipio) }}"
                    >

                    @error('municipio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label
                        for="domicilio"
                        class="form-label fw-bold"
                    >
                        Domicilio
                    </label>

                    <textarea
                        id="domicilio"
                        name="domicilio"
                        rows="3"
                        class="form-control @error('domicilio') is-invalid @enderror"
                    >{{ old('domicilio', $registro->domicilio) }}</textarea>

                    @error('domicilio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label
                        for="estado"
                        class="form-label fw-bold"
                    >
                        Estado
                    </label>

                    <input
                        type="text"
                        id="estado"
                        name="estado"
                        class="form-control @error('estado') is-invalid @enderror"
                        value="{{ old('estado', $registro->estado ?? 'Michoacán') }}"
                    >

                    @error('estado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label
                        for="estatus"
                        class="form-label fw-bold"
                    >
                        Estatus *
                    </label>

                    <select
                        id="estatus"
                        name="estatus"
                        class="form-select @error('estatus') is-invalid @enderror"
                        required
                    >

                        <option
                            value="activo"
                            {{ old('estatus', $registro->estatus) === 'activo' ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="inactivo"
                            {{ old('estatus', $registro->estatus) === 'inactivo' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                        <option
                            value="suspendido"
                            {{ old('estatus', $registro->estatus) === 'suspendido' ? 'selected' : '' }}
                        >
                            Suspendido
                        </option>

                        <option
                            value="baja"
                            {{ old('estatus', $registro->estatus) === 'baja' ? 'selected' : '' }}
                        >
                            Baja
                        </option>

                    </select>

                    @error('estatus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-4">

                    <label
                        for="vigencia"
                        class="form-label fw-bold"
                    >
                        Vigencia
                    </label>

                    <input
                        type="date"
                        id="vigencia"
                        name="vigencia"
                        class="form-control @error('vigencia') is-invalid @enderror"
                        value="{{ old('vigencia', !empty($registro->vigencia) ? \Carbon\Carbon::parse($registro->vigencia)->format('Y-m-d') : '') }}"
                    >

                    @error('vigencia')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <div class="alert alert-light border mb-0">

                        <div class="small text-muted">
                            Folio interno SICA
                        </div>

                        <div class="fw-bold">
                            {{ $registro->folio_afiliado ?? 'Sin folio' }}
                        </div>

                    </div>

                </div>


                <div class="col-12">

                    <hr>

                    <div class="d-flex justify-content-end gap-2 flex-wrap">

                        <a
                            href="{{ url('/afiliaciones/' . $registro->id) }}"
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