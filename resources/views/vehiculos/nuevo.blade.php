@extends('layouts.sica')

@section('titulo', 'Registrar vehículo')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Registrar vehículo</h1>
        <p>Alta de una nueva unidad dentro de SICA.</p>
    </div>

    <a href="{{ url('/vehiculos') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>
</div>


<form
    method="POST"
    action="{{ url('/vehiculos') }}"
    autocomplete="off"
>
    @csrf

    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">
            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-person-check fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Afiliado responsable
                    </h5>

                    <p class="text-muted small mb-0">
                        Selecciona a quién quedará vinculada la unidad.
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12">

                    <label for="afiliado_id" class="form-label fw-bold">
                        Afiliado
                        <span class="text-danger">*</span>
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

                        @foreach(($afiliados ?? $afiliaciones ?? []) as $afiliado)

                            <option
                                value="{{ $afiliado->id }}"
                                {{
                                    old(
                                        'afiliado_id',
                                        request('afiliado_id')
                                    ) == $afiliado->id
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                {{ $afiliado->folio_afiliado ?? 'Sin folio' }}
                                -
                                {{ $afiliado->nombre ?? 'Sin nombre' }}
                            </option>

                        @endforeach

                    </select>

                    @error('afiliado_id')
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
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-car-front fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Datos del vehículo
                    </h5>

                    <p class="text-muted small mb-0">
                        Información general de la unidad.
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label for="marca" class="form-label fw-bold">
                        Marca
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="marca"
                        name="marca"
                        class="form-control @error('marca') is-invalid @enderror"
                        value="{{ old('marca') }}"
                        placeholder="Ej. Nissan"
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
                        Submarca
                    </label>

                    <input
                        type="text"
                        id="submarca"
                        name="submarca"
                        class="form-control @error('submarca') is-invalid @enderror"
                        value="{{ old('submarca') }}"
                        placeholder="Ej. Versa"
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
                        value="{{ old('anio') }}"
                        min="1900"
                        max="{{ now()->year + 1 }}"
                        placeholder="{{ now()->year }}"
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
                        value="{{ old('color') }}"
                        placeholder="Color"
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
                        class="form-control text-uppercase @error('placas') is-invalid @enderror"
                        value="{{ old('placas') }}"
                        placeholder="Placas"
                        oninput="this.value = this.value.toUpperCase()"
                    >

                    @error('placas')
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
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-upc-scan fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Identificación de la unidad
                    </h5>

                    <p class="text-muted small mb-0">
                        Series y números de control del vehículo.
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12">

                    <label for="vin" class="form-label fw-bold">
                        VIN / Número de serie
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="vin"
                        name="vin"
                        class="form-control font-monospace text-uppercase @error('vin') is-invalid @enderror"
                        value="{{ old('vin') }}"
                        maxlength="17"
                        placeholder="17 caracteres"
                        oninput="this.value = this.value.toUpperCase()"
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
                        value="{{ old('motor') }}"
                        placeholder="Tipo o especificación del motor"
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
                        class="form-control text-uppercase @error('serie_motor') is-invalid @enderror"
                        value="{{ old('serie_motor') }}"
                        placeholder="Número de serie del motor"
                        oninput="this.value = this.value.toUpperCase()"
                    >

                    @error('serie_motor')
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
                    class="rounded-3 bg-danger-subtle text-danger d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-shield-lock fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Control SICA
                    </h5>

                    <p class="text-muted small mb-0">
                        Estado operativo y vigencia de la unidad.
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label for="estatus" class="form-label fw-bold">
                        Estatus
                    </label>

                    <select
                        id="estatus"
                        name="estatus"
                        class="form-select @error('estatus') is-invalid @enderror"
                    >

                        <option
                            value="activo"
                            {{ old('estatus', 'activo') === 'activo' ? 'selected' : '' }}
                        >
                            Activo
                        </option>

                        <option
                            value="inactivo"
                            {{ old('estatus') === 'inactivo' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                        <option
                            value="suspendido"
                            {{ old('estatus') === 'suspendido' ? 'selected' : '' }}
                        >
                            Suspendido
                        </option>

                        <option
                            value="robado"
                            {{ old('estatus') === 'robado' ? 'selected' : '' }}
                        >
                            Reportado como robado
                        </option>

                        <option
                            value="baja"
                            {{ old('estatus') === 'baja' ? 'selected' : '' }}
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


                <div class="col-12 col-md-6">

                    <label for="vigencia" class="form-label fw-bold">
                        Vigencia
                    </label>

                    <input
                        type="date"
                        id="vigencia"
                        name="vigencia"
                        class="form-control @error('vigencia') is-invalid @enderror"
                        value="{{ old('vigencia', now()->addYear()->format('Y-m-d')) }}"
                    >

                    @error('vigencia')
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
                        Guardar unidad
                    </div>

                    <small class="text-muted">
                        Revisa especialmente VIN y afiliado antes de registrar.
                    </small>
                </div>


                <div class="d-flex gap-2 flex-wrap">

                    <a
                        href="{{ url('/vehiculos') }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-sica"
                    >
                        <i class="bi bi-check-circle me-2"></i>
                        Registrar vehículo
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection