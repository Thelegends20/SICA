@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <h5>Afiliados</h5>
            <h2>{{ $afiliados }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <h5>Vehículos</h5>
            <h2>{{ $vehiculos }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <h5>Vigentes</h5>
            <h2 class="text-success">{{ $vigentes }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <h5>Vencidos</h5>
            <h2 class="text-danger">{{ $vencidos }}</h2>
        </div>
    </div>

</div>

<hr class="my-5">

<div class="row">

    <div class="col-md-4 mb-3">
        <a href="/nueva" class="btn btn-success w-100 btn-lg">
            ➕ Nueva Afiliación
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="#" class="btn btn-primary w-100 btn-lg">
            🚗 Registrar Vehículo
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="#" class="btn btn-dark w-100 btn-lg">
            📊 Reportes
        </a>
    </div>

</div>

@endsection