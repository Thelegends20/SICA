@extends('layouts.sica')

@section('titulo', 'Crear credencial')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Crear credencial</h1>
        <p>Generación de una nueva credencial vinculada a un afiliado.</p>
    </div>

    <a href="{{ url('/credenciales') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<form
    method="POST"
    action="{{ url('/credenciales') }}"
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
                        Afiliado
                    </h5>

                    <p class="text-muted small mb-0">
                        Selecciona la persona a la que se emitirá la credencial.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12">

                    <label for="afiliado_id" class="form-label fw-bold">
                        Seleccionar afiliado
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
                    class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-person-vcard fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Datos de la credencial
                    </h5>

                    <p class="text-muted small mb-0">
                        Información de control y vigencia.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label for="estatus" class="form-label fw-bold">
                        Estado
                    </label>

                    <select
                        id="estatus"
                        name="estatus"
                        class="form-select @error('estatus') is-invalid @enderror"
                    >

                        <option
                            value="activa"
                            {{ old('estatus', 'activa') === 'activa' ? 'selected' : '' }}
                        >
                            Activa
                        </option>

                        <option
                            value="cancelada"
                            {{ old('estatus') === 'cancelada' ? 'selected' : '' }}
                        >
                            Cancelada
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
                        Emitir credencial
                    </div>

                    <small class="text-muted">
                        Verifica el afiliado seleccionado antes de guardar.
                    </small>

                </div>


                <div class="d-flex gap-2">

                    <a
                        href="{{ url('/credenciales') }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-sica"
                    >
                        <i class="bi bi-person-vcard me-2"></i>
                        Generar credencial
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection