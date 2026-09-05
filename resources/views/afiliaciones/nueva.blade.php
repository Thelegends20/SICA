@extends('layouts.sica')

@section('titulo', 'Nueva afiliación')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Nueva afiliación</h1>
        <p>Registro de un nuevo afiliado en SICA.</p>
    </div>

    <a href="{{ url('/afiliaciones') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>
</div>


<form
    method="POST"
    action="{{ url('/afiliaciones') }}"
    enctype="multipart/form-data"
    autocomplete="off"
>
    @csrf


    {{-- FOTOGRAFÍA --}}
    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-camera fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Fotografía
                    </h5>

                    <p class="text-muted small mb-0">
                        Fotografía que se utilizará en la credencial del afiliado.
                    </p>
                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-4 align-items-center">

                <div class="col-12 col-md-auto">

                    <div
                        class="border rounded-4 bg-light overflow-hidden d-flex align-items-center justify-content-center"
                        style="width:150px;height:180px;"
                    >

                        <img
                            id="fotoPreview"
                            src=""
                            alt="Vista previa"
                            style="
                                width:100%;
                                height:100%;
                                object-fit:cover;
                                display:none;
                            "
                        >

                        <div
                            id="fotoPlaceholder"
                            class="text-center text-secondary px-3"
                        >
                            <i class="bi bi-person-bounding-box fs-1"></i>

                            <div class="small mt-2">
                                Sin fotografía
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-12 col-md">

                    <label for="foto" class="form-label fw-bold">
                        Seleccionar fotografía
                    </label>

                    <input
                        type="file"
                        class="form-control @error('foto') is-invalid @enderror"
                        id="foto"
                        name="foto"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text mt-2">
                        Formatos permitidos: JPG, PNG y WEBP. Máximo 5 MB.
                    </div>

                    <div class="form-text">
                        Para la credencial se recomienda una fotografía vertical,
                        de frente y con buena iluminación.
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DATOS PERSONALES --}}
    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-person fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Datos personales
                    </h5>

                    <p class="text-muted small mb-0">
                        Información general del afiliado.
                    </p>
                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12">

                    <label for="nombre" class="form-label fw-bold">
                        Nombre completo
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Nombre completo del afiliado"
                        required
                    >

                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="curp" class="form-label fw-bold">
                        CURP
                    </label>

                    <input
                        type="text"
                        class="form-control text-uppercase @error('curp') is-invalid @enderror"
                        id="curp"
                        name="curp"
                        value="{{ old('curp') }}"
                        maxlength="18"
                        placeholder="CURP"
                        oninput="this.value = this.value.toUpperCase()"
                    >

                    @error('curp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="rfc" class="form-label fw-bold">
                        RFC
                    </label>

                    <input
                        type="text"
                        class="form-control text-uppercase @error('rfc') is-invalid @enderror"
                        id="rfc"
                        name="rfc"
                        value="{{ old('rfc') }}"
                        maxlength="13"
                        placeholder="RFC"
                        oninput="this.value = this.value.toUpperCase()"
                    >

                    @error('rfc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="ine" class="form-label fw-bold">
                        INE
                    </label>

                    <input
                        type="text"
                        class="form-control @error('ine') is-invalid @enderror"
                        id="ine"
                        name="ine"
                        value="{{ old('ine') }}"
                        placeholder="Clave o identificación INE"
                    >

                    @error('ine')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="telefono" class="form-label fw-bold">
                        Teléfono
                    </label>

                    <input
                        type="tel"
                        class="form-control @error('telefono') is-invalid @enderror"
                        id="telefono"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        placeholder="Número telefónico"
                    >

                    @error('telefono')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="correo" class="form-label fw-bold">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        class="form-control @error('correo') is-invalid @enderror"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="correo@ejemplo.com"
                    >

                    @error('correo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- DOMICILIO --}}
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

            <div class="row g-3">

                <div class="col-12">

                    <label for="domicilio" class="form-label fw-bold">
                        Domicilio
                    </label>

                    <input
                        type="text"
                        class="form-control @error('domicilio') is-invalid @enderror"
                        id="domicilio"
                        name="domicilio"
                        value="{{ old('domicilio') }}"
                        placeholder="Calle, número, colonia o localidad"
                    >

                    @error('domicilio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="municipio" class="form-label fw-bold">
                        Municipio
                    </label>

                    <input
                        type="text"
                        class="form-control @error('municipio') is-invalid @enderror"
                        id="municipio"
                        name="municipio"
                        value="{{ old('municipio') }}"
                        placeholder="Municipio"
                    >

                    @error('municipio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="estado" class="form-label fw-bold">
                        Estado
                    </label>

                    <input
                        type="text"
                        class="form-control @error('estado') is-invalid @enderror"
                        id="estado"
                        name="estado"
                        value="{{ old('estado', 'Michoacán') }}"
                        placeholder="Estado"
                    >

                    @error('estado')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- CONTROL --}}
    <div class="card card-sica mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                    style="width:48px;height:48px;"
                >
                    <i class="bi bi-shield-check fs-4"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Control de afiliación
                    </h5>

                    <p class="text-muted small mb-0">
                        Estado y vigencia del registro.
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
                        class="form-select @error('estatus') is-invalid @enderror"
                        id="estatus"
                        name="estatus"
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
                        class="form-control @error('vigencia') is-invalid @enderror"
                        id="vigencia"
                        name="vigencia"
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


    {{-- GUARDAR --}}
    <div class="card card-sica">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <div class="fw-bold">
                        Registrar afiliación
                    </div>

                    <small class="text-muted">
                        Verifica los datos y la fotografía antes de guardar.
                    </small>
                </div>


                <div class="d-flex gap-2">

                    <a
                        href="{{ url('/afiliaciones') }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-sica"
                    >
                        <i class="bi bi-check-circle me-2"></i>
                        Guardar afiliado
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputFoto = document.getElementById('foto');
    const preview = document.getElementById('fotoPreview');
    const placeholder = document.getElementById('fotoPlaceholder');

    if (!inputFoto) {
        return;
    }

    inputFoto.addEventListener('change', function (event) {

        const archivo = event.target.files[0];

        if (!archivo) {
            preview.src = '';
            preview.style.display = 'none';
            placeholder.style.display = 'block';
            return;
        }

        const lector = new FileReader();

        lector.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };

        lector.readAsDataURL(archivo);

    });

});
</script>

@endsection