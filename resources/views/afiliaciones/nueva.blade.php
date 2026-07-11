@extends('layouts.app')

@section('titulo', 'Nueva Afiliación')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Nueva Afiliación</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('afiliados.store') }}" method="POST">

        @csrf

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-success text-white">
                Datos del Afiliado
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="{{ old('nombre') }}"
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input
                            type="text"
                            name="telefono"
                            class="form-control"
                            value="{{ old('telefono') }}"
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">INE</label>
                        <input
                            type="text"
                            name="ine"
                            class="form-control"
                            value="{{ old('ine') }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">CURP</label>
                        <input
                            type="text"
                            name="curp"
                            class="form-control"
                            value="{{ old('curp') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">RFC</label>
                        <input
                            type="text"
                            name="rfc"
                            class="form-control"
                            value="{{ old('rfc') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            value="{{ old('correo') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Domicilio</label>
                        <input
                            type="text"
                            name="domicilio"
                            class="form-control"
                            value="{{ old('domicilio') }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Municipio</label>
                        <input
                            type="text"
                            name="municipio"
                            class="form-control"
                            value="{{ old('municipio') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estado</label>
                        <input
                            type="text"
                            name="estado"
                            class="form-control"
                            value="{{ old('estado') }}">
                    </div>

                </div>

            </div>

        </div>

        <div class="text-end">

            <button type="submit" class="btn btn-success btn-lg">
                Guardar Afiliación
            </button>

        </div>

    </form>

</div>

@endsection