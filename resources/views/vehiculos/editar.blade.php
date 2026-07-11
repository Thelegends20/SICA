@extends('layouts.app')

@section('titulo','Editar Vehículo')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Editar Vehículo</h2>
            <small class="text-muted">
                Folio:
                <strong>{{ $vehiculo->folio_vehiculo }}</strong>
            </small>
        </div>

        <span class="badge bg-success fs-6">
            {{ $vehiculo->estatus }}
        </span>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Revisa los datos:</strong>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Datos del Vehículo
        </div>


        <div class="card-body">


            <form action="{{ route('vehiculos.update', $vehiculo->id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                <div class="row">


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Marca
                        </label>

                        <input 
                            type="text"
                            name="marca"
                            class="form-control"
                            value="{{ $vehiculo->marca }}"
                            required>

                    </div>



                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Submarca
                        </label>

                        <input 
                            type="text"
                            name="submarca"
                            class="form-control"
                            value="{{ $vehiculo->submarca }}">

                    </div>



                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Modelo
                        </label>

                        <input 
                            type="text"
                            name="modelo"
                            class="form-control"
                            value="{{ $vehiculo->modelo }}"
                            required>

                    </div>



                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Año
                        </label>

                        <input 
                            type="number"
                            name="anio"
                            class="form-control"
                            value="{{ $vehiculo->anio }}"
                            required>

                    </div>



                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Color
                        </label>

                        <input 
                            type="text"
                            name="color"
                            class="form-control"
                            value="{{ $vehiculo->color }}"
                            required>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            VIN
                        </label>

                        <input 
                            type="text"
                            name="vin"
                            class="form-control"
                            value="{{ $vehiculo->vin }}"
                            required>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Motor
                        </label>

                        <input 
                            type="text"
                            name="motor"
                            class="form-control"
                            value="{{ $vehiculo->motor }}">

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Placas
                        </label>

                        <input 
                            type="text"
                            name="placas"
                            class="form-control"
                            value="{{ $vehiculo->placas }}">

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Serie Motor
                        </label>

                        <input 
                            type="text"
                            name="serie_motor"
                            class="form-control"
                            value="{{ $vehiculo->serie_motor }}">

                    </div>


                </div>


                <div class="d-flex justify-content-between">


                    <a href="{{ route('vehiculos.show', $vehiculo->id) }}"
                       class="btn btn-secondary">

                        Cancelar

                    </a>


                    <button type="submit"
                            class="btn btn-success">

                        Guardar Cambios

                    </button>


                </div>


            </form>


        </div>

    </div>


</div>

@endsection