@extends('layouts.app')

@section('titulo','Expediente del Vehículo')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Expediente del Vehículo</h2>
        <small>{{ $vehiculo->folio_vehiculo }}</small>
    </div>

    <span class="badge bg-success fs-6">
        {{ $vehiculo->estatus }}
    </span>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

    <span>
        Datos del Vehículo
    </span>

    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}"
       class="btn btn-warning btn-sm">
        Editar
    </a>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th>Marca</th>
                        <td>{{ $vehiculo->marca }}</td>
                    </tr>

                    <tr>
                        <th>Submarca</th>
                        <td>{{ $vehiculo->submarca }}</td>
                    </tr>

                    <tr>
                        <th>Modelo</th>
                        <td>{{ $vehiculo->modelo }}</td>
                    </tr>

                    <tr>
                        <th>Año</th>
                        <td>{{ $vehiculo->anio }}</td>
                    </tr>

                    <tr>
                        <th>Color</th>
                        <td>{{ $vehiculo->color }}</td>
                    </tr>

                    <tr>
                        <th>VIN</th>
                        <td>{{ $vehiculo->vin }}</td>
                    </tr>

                    <tr>
                        <th>Motor</th>
                        <td>{{ $vehiculo->motor }}</td>
                    </tr>

                    <tr>
                        <th>Placas</th>
                        <td>{{ $vehiculo->placas }}</td>
                    </tr>

                    <tr>
                        <th>Vigencia</th>
                        <td>{{ $vehiculo->vigencia }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header bg-success text-white">
                Propietario
            </div>

            <div class="card-body">

                <h4>{{ $vehiculo->afiliado->nombre }}</h4>

                <p><strong>Folio:</strong> {{ $vehiculo->afiliado->folio_afiliado }}</p>

                <p><strong>Teléfono:</strong> {{ $vehiculo->afiliado->telefono }}</p>

                <p><strong>Domicilio:</strong> {{ $vehiculo->afiliado->domicilio }}</p>

                <a href="/afiliado/{{ $vehiculo->afiliado->id }}"
                   class="btn btn-primary">

                    Ver Expediente del Afiliado

                </a>

            </div>

        </div>

    </div>

</div>

@endsection