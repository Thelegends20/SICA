@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        ⚙️ Configuración del Sistema
    </h2>

    <div class="row g-4">

        <div class="col-md-3">
            <a href="{{ route('configuracion.coordinadores') }}" class="btn btn-primary w-100 p-4">
                👥 Coordinadores
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.administradores') }}" class="btn btn-success w-100 p-4">
                👑 Administradores
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.permisos') }}" class="btn btn-warning w-100 p-4">
                🔐 Permisos
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.folios') }}" class="btn btn-info w-100 p-4">
                📄 Folios
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.parametros') }}" class="btn btn-secondary w-100 p-4">
                ⚙️ Parámetros
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.auditoria') }}" class="btn btn-dark w-100 p-4">
                📋 Auditoría
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('configuracion.respaldos') }}" class="btn btn-danger w-100 p-4">
                💾 Respaldos
            </a>
        </div>

    </div>

</div>

@endsection