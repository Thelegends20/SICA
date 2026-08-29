@extends('layouts.sica')

@section('titulo', 'Nuevo usuario')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Nuevo usuario</h1>
        <p>Alta de un nuevo usuario con acceso al sistema SICA.</p>
    </div>

    <a href="{{ url('/usuarios') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<form
    method="POST"
    action="{{ url('/usuarios') }}"
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
                    <i class="bi bi-person-plus fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Datos del usuario
                    </h5>

                    <p class="text-muted small mb-0">
                        Información básica para crear el acceso.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12">

                    <label for="name" class="form-label fw-bold">
                        Nombre
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Nombre completo"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label for="email" class="form-label fw-bold">
                        Correo electrónico
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="usuario@ejemplo.com"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12 col-md-6">

                    <label for="password" class="form-label fw-bold">
                        Contraseña
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Contraseña"
                            required
                        >

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            onclick="alternarPassword('password', 'iconoPassword')"
                        >
                            <i
                                class="bi bi-eye"
                                id="iconoPassword"
                            ></i>
                        </button>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="col-12 col-md-6">

                    <label for="password_confirmation" class="form-label fw-bold">
                        Confirmar contraseña
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Repite la contraseña"
                            required
                        >

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            onclick="alternarPassword('password_confirmation', 'iconoConfirmacion')"
                        >
                            <i
                                class="bi bi-eye"
                                id="iconoConfirmacion"
                            ></i>
                        </button>

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
                    <i class="bi bi-shield-lock fs-4"></i>
                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        Nivel de acceso
                    </h5>

                    <p class="text-muted small mb-0">
                        Define los permisos generales del usuario.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-4">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label for="rol" class="form-label fw-bold">
                        Rol
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        id="rol"
                        name="rol"
                        class="form-select @error('rol') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Selecciona un rol
                        </option>

                        <option
                            value="ADMIN_PRINCIPAL"
                            {{ old('rol') === 'ADMIN_PRINCIPAL' ? 'selected' : '' }}
                        >
                            Administrador principal
                        </option>

                        <option
                            value="COORDINADOR"
                            {{ old('rol') === 'COORDINADOR' ? 'selected' : '' }}
                        >
                            Coordinador
                        </option>

                    </select>

                    @error('rol')
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
                        Crear usuario
                    </div>

                    <small class="text-muted">
                        Revisa el correo, contraseña y rol antes de guardar.
                    </small>

                </div>


                <div class="d-flex gap-2 flex-wrap">

                    <a
                        href="{{ url('/usuarios') }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-sica"
                    >
                        <i class="bi bi-person-check me-2"></i>
                        Crear usuario
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection


@push('scripts')

<script>

    function alternarPassword(campoId, iconoId)
    {
        const campo = document.getElementById(campoId);
        const icono = document.getElementById(iconoId);

        if (campo.type === 'password') {

            campo.type = 'text';

            icono.classList.remove('bi-eye');
            icono.classList.add('bi-eye-slash');

        } else {

            campo.type = 'password';

            icono.classList.remove('bi-eye-slash');
            icono.classList.add('bi-eye');

        }
    }

</script>

@endpush